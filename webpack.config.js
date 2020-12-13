const path = require("path");

module.exports = {
    mode: 'production',
    entry: {
        'can-i-use-cookies': path.resolve(process.cwd(), 'src/can-i-use-cookies.js')
    },
    output: {
        filename: '[name].js',
        library: ['[name]'],
        libraryTarget: 'window',
        path: path.resolve(process.cwd(), 'build')
    },
    resolve: {
        extensions: ['.js']
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: 'babel-loader'
            },
            {
                test: /\.css$/i,
                use: [
                    'style-loader',
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: false,
                            importLoaders: 1,
                            modules: false
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            plugins: [
                                require('autoprefixer'),
                                require('cssnano')
                            ]
                        }
                    }
                ],
            }
        ],
    },
    stats: {
        children: false,
    }
};
