// generate-full-changelog.js
const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

class ChangelogGenerator {
    constructor() {
        this.types = {
            feat: { title: 'Features', emoji: '✨' },
            fix: { title: 'Bug Fixes', emoji: '🐛' },
            perf: { title: 'Performance Improvements', emoji: '⚡' },
            docs: { title: 'Documentation', emoji: '📚' },
            style: { title: 'Code Style', emoji: '💎' },
            refactor: { title: 'Code Refactoring', emoji: '♻️' },
            test: { title: 'Tests', emoji: '🧪' },
            chore: { title: 'Chores', emoji: '🔧' },
            build: { title: 'Build System', emoji: '🛠️' },
            ci: { title: 'Continuous Integration', emoji: '🤖' }
        };

        // Try to get repository URL for commit links
        this.repoUrl = this.getRepositoryUrl();
    }

    /**
     * Get repository URL for commit links
     */
    getRepositoryUrl() {
        try {
            // Try to get remote origin URL
            const remoteUrl = this.execGitCommand('git config --get remote.origin.url').trim();

            if (remoteUrl) {
                // Convert SSH URL to HTTPS if needed
                if (remoteUrl.startsWith('git@')) {
                    return remoteUrl
                        .replace(':', '/')
                        .replace('git@', 'https://')
                        .replace('.git', '');
                }
                // Convert HTTPS URL
                if (remoteUrl.startsWith('https')) {
                    return remoteUrl.replace('.git', '');
                }
            }
        } catch (error) {
            // Silently fail if no remote
        }

        // Return null if no repo URL found
        return null;
    }

    /**
     * Execute git command with proper encoding
     */
    execGitCommand(command) {
        try {
            // Use proper encoding for Windows
            const options = {
                encoding: 'utf8',
                stdio: ['pipe', 'pipe', 'ignore']
            };

            // On Windows, ensure we use UTF-8
            if (process.platform === 'win32') {
                return execSync(`chcp 65001 >nul && ${command}`, options).toString();
            }

            return execSync(command, options).toString();
        } catch (error) {
            return '';
        }
    }

    /**
     * Get all commits with their full metadata
     */
    getAllCommits() {
        // Include hash and subject for commit links
        const command = 'git log --pretty=format:"%H%n%h%n%s%n%b%n=====" --no-merges';
        const output = this.execGitCommand(command);

        const commits = [];
        const blocks = output.split('=====\n').filter(b => b.trim());

        blocks.forEach(block => {
            const lines = block.trim().split('\n');
            if (lines.length >= 3) {
                const hash = lines[0];
                const shortHash = lines[1];
                const subject = lines[2];
                const body = lines.slice(3).join('\n').trim();

                commits.push({
                    hash,
                    shortHash,
                    subject,
                    body,
                    full: subject + (body ? '\n' + body : '')
                });
            }
        });

        return commits;
    }

    /**
     * Parse commit to extract type, scope, and message
     */
    parseCommit(commit) {
        const fullMessage = commit.full || commit.subject;

        // Pattern 1: conventional commit with scope: feat(scope): message
        let match = fullMessage.match(/^(\w+)(\(([^)]+)\))?:\s*(.+)$/m);
        if (match) {
            const [, type, , scope, message] = match;
            return {
                type: type.toLowerCase(),
                scope: scope ? scope.trim() : null,
                message: message.trim(),
                hash: commit.shortHash,
                fullHash: commit.hash
            };
        }

        // Pattern 2: simple type: message
        match = fullMessage.match(/^(\w+):\s*(.+)$/m);
        if (match) {
            const [, type, message] = match;
            return {
                type: type.toLowerCase(),
                scope: null,
                message: message.trim(),
                hash: commit.shortHash,
                fullHash: commit.hash
            };
        }

        return null;
    }

    /**
     * Format scope name for display
     */
    formatScopeName(scope) {
        if (!scope) return 'General';

        // Convert kebab-case or snake_case to Title Case
        return scope
            .split(/[-_]/)
            .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
            .join(' ');
    }

    /**
     * Create commit link if repository URL is available
     */
    createCommitLink(commitHash, message) {
        if (this.repoUrl) {
            return `[${message}](<${this.repoUrl}/commit/${commitHash}>)`;
        }
        return `${message} (\`${commitHash}\`)`;
    }

    /**
     * Group commits by type and scope
     */
    groupCommits(commits) {
        const grouped = {};

        commits.forEach(commit => {
            const parsed = this.parseCommit(commit);
            if (!parsed) return;

            const type = parsed.type;
            if (!this.types[type]) return; // Only include defined types

            if (!grouped[type]) {
                grouped[type] = {
                    scoped: {},
                    unscoped: []
                };
            }

            // Create commit line with optional link
            const commitLine = `  - ${this.createCommitLink(parsed.hash, parsed.message)}`;

            if (parsed.scope) {
                if (!grouped[type].scoped[parsed.scope]) {
                    grouped[type].scoped[parsed.scope] = [];
                }
                grouped[type].scoped[parsed.scope].push(commitLine);
            } else {
                grouped[type].unscoped.push(commitLine);
            }
        });

        return grouped;
    }

    /**
     * Generate the changelog content
     */
    generate() {
        // Get all commits
        const commits = this.getAllCommits();

        if (commits.length === 0) {
            return '# Changelog\n\nNo commits found in repository.';
        }

        // Group commits
        const grouped = this.groupCommits(commits);

        // Generate version and date
        const version = this.getVersion();
        const date = new Date().toISOString().slice(0, 10);

        // Build markdown with UTF-8 BOM for Windows
        let markdown = '# Changelog\n\n';
        markdown += `## [${version}] - ${date}\n\n`;

        let hasContent = false;

        // Generate sections for each type in specific order
        const typeOrder = ['feat', 'fix', 'perf', 'docs', 'style', 'refactor', 'test', 'build', 'ci', 'chore'];

        for (const type of typeOrder) {
            const typeGroup = grouped[type];
            if (!typeGroup) continue;

            const hasScoped = Object.keys(typeGroup.scoped).length > 0;
            const hasUnscoped = typeGroup.unscoped.length > 0;

            if (!hasScoped && !hasUnscoped) continue;

            const typeConfig = this.types[type];
            markdown += `## ${typeConfig.emoji} ${typeConfig.title}\n\n`;
            hasContent = true;

            // Add scoped commits first (organized by scope)
            if (hasScoped) {
                // Sort scopes alphabetically
                const sortedScopes = Object.keys(typeGroup.scoped).sort((a, b) => {
                    return a.localeCompare(b);
                });

                sortedScopes.forEach(scope => {
                    const formattedScope = this.formatScopeName(scope);
                    markdown += `### ${formattedScope}\n`;
                    markdown += typeGroup.scoped[scope].join('\n') + '\n\n';
                });
            }

            // Add unscoped commits under "General" section
            if (hasUnscoped) {
                markdown += `### General\n`;
                markdown += typeGroup.unscoped.join('\n') + '\n\n';
            }
        }

        if (!hasContent) {
            markdown += `*No conventional commits found in the repository.*\n\n`;
            markdown += `**Tip:** Use commit messages like:\n`;
            markdown += `- feat: add new feature\n`;
            markdown += `- feat(api): add new endpoint\n`;
            markdown += `- fix(auth): resolve login issue\n`;
        }

        // Add footer with stats if we have a repo URL
        if (this.repoUrl) {
            markdown += `---\n`;
            markdown += `*Generated from [${this.getRepoName()}](${this.repoUrl})*\n`;
        }

        return markdown;
    }

    /**
     * Get repository name from URL
     */
    getRepoName() {
        if (!this.repoUrl) return 'repository';
        const parts = this.repoUrl.split('/');
        return parts[parts.length - 1] || 'repository';
    }

    /**
     * Get version from tags or generate one
     */
    getVersion() {
        try {
            const tag = this.execGitCommand('git describe --tags --abbrev=0').trim();
            if (tag) return tag;
        } catch {}

        const date = new Date();
        return `v${date.getFullYear()}.${String(date.getMonth() + 1).padStart(2, '0')}.${String(date.getDate()).padStart(2, '0')}`;
    }

    /**
     * Write changelog to file
     */
    writeToFile() {
        try {
            console.log('📖 Reading commits...');
            const commits = this.getAllCommits();
            console.log(`📊 Found ${commits.length} total commits`);

            // Show repository info
            if (this.repoUrl) {
                console.log(`🔗 Repository: ${this.repoUrl}`);
            } else {
                console.log(`🔗 No remote repository found (commit links will show hashes only)`);
            }

            // Show sample commits
            console.log('\n📝 Sample commits:');
            commits.slice(0, 3).forEach((commit, i) => {
                console.log(`  ${i+1}. ${commit.subject.substring(0, 70)}${commit.subject.length > 70 ? '...' : ''} (${commit.shortHash})`);
            });

            const content = this.generate();
            const fileName = 'CHANGELOG.md';

            // Write file with UTF-8 BOM for Windows to ensure emojis display properly
            const BOM = '\uFEFF';
            fs.writeFileSync(fileName, BOM + content, { encoding: 'utf8' });

            console.log(`\n✅ CHANGELOG.md has been generated successfully!`);
            console.log(`📝 Version: ${this.getVersion()}`);

            // Count categorized commits
            const grouped = this.groupCommits(commits);
            let categorizedCount = 0;
            Object.values(grouped).forEach(g => {
                categorizedCount += g.unscoped.length;
                Object.values(g.scoped).forEach(c => categorizedCount += c.length);
            });

            console.log(`📊 Categorized commits: ${categorizedCount} out of ${commits.length}`);

            // Show first few lines of the generated file
            console.log('\n📄 First 10 lines of CHANGELOG.md:');
            const previewLines = content.split('\n').slice(0, 10);
            previewLines.forEach(line => {
                // Don't try to display the BOM character
                if (line) console.log(line);
            });

        } catch (error) {
            console.error('❌ Error:', error.message);
        }
    }
}

// Run the generator
console.log('🚀 Generating changelog...\n');
const generator = new ChangelogGenerator();
generator.writeToFile();