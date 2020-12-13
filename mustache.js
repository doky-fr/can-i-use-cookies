#!/usr/bin/env node

const packageJson = require('./package.json');
const mustacheData = {
    'plugin-version': packageJson.version
};
console.log(JSON.stringify(mustacheData));
