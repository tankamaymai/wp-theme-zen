let defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require("path");

module.exports = {
  ...defaultConfig,
  entry: {
    blocks: "./js/blocks.js",
    newBlocks: "./src/index.js",
    "toolbar-text-resize": "./js/toolbar-text-resize.js",
    "custom-block-margin-padding": "./js/custom-block-margin-padding.js",
    "responsive": "./js/responsive.js",
    "content-with": "./js/content-with.js", 
    "icon-picker": "./js/icon-picker.js", 
  },
  output: {
    path: path.resolve(__dirname, "dist"),
    filename: "[name].bundle.js",
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env", "@babel/preset-react"],
          },
        },
      },
    ],
  },
  mode: "production",
  devtool: "source-map",
};