find ./ -type f -d 1 -not -name 'composer.*' -not -name 'LICENSE' -not -name 'README.md' -not -name '.gitignore' -exec rm {} \+
find ./ -type d -d 1 -not -name 'bin' -not -name '.git' -exec rm -rf {} \+
