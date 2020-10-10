#!/usr/bin/env node

/**
 * Output Mustache JSON data view on stdout.
 */
const packageJson = require("./package.json");

const mustacheData = {
    "plugin-version": packageJson.version,
};

console.log(JSON.stringify(mustacheData));
