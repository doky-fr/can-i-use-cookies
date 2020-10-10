/**
 * Dependencies
 */
const DependencyExtractionWebpackPlugin = require("@wordpress/dependency-extraction-webpack-plugin");
const path = require("path");

/**
 * Check environment
 */
const isProduction = process.env.NODE_ENV === "production";
const mode = isProduction ? "production" : "development";

/**
 * Webpack config
 */
const config = {
    mode,
    entry: {
        public: path.resolve(process.cwd(), "src/js/public.ts")
    },
    output: {
        filename: "[name].js",
        library: ["[name]"],
        libraryTarget: "window",
        path: path.resolve(process.cwd(), "build/js")
    },
    externals: {
        jquery: "jQuery"
    },
    resolve: {
        extensions: [".ts", ".tsx", ".js"]
    },
    module: {
        rules: [
            {
                test: /\.ts|\.tsx|\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: [
                            "@wordpress/babel-preset-default",
                            "@babel/typescript"
                        ],
                        plugins: [
                            "@babel/plugin-transform-runtime",
                            "@babel/proposal-class-properties",
                            "@babel/proposal-object-rest-spread"
                        ]
                    }
                },
            },
            {
                test: /\.css$/i,
                use: [
                    "style-loader",
                    {
                        loader: "css-loader",
                        options: {
                            sourceMap: !isProduction,
                            importLoaders: 1,
                            modules: false
                        }
                    },
                    {
                        loader: "postcss-loader",
                        options: {
                            plugins: [
                                require("autoprefixer"),
                                require("cssnano")
                            ]
                        }
                    }
                ],
            }
        ],
    },
    plugins: [
        new DependencyExtractionWebpackPlugin({injectPolyfill: true}),
    ].filter(Boolean),
    stats: {
        children: false,
    }
};

/**
 * Activate source map generation if not production
 */
if (!isProduction) {
    config.devtool = "source-map";
    config.module.rules.unshift({
        test: /\.ts|\.tsx$/,
        use: require.resolve("source-map-loader"),
        enforce: "pre",
    });
}

module.exports = config;
