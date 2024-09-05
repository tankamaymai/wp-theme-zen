const path = require("path");

module.exports = {
  entry: {
    "custom-blocks": "./js/custom-blocks.js", // 既存のエントリーポイント
    blocks: "./js/blocks.js", // 既存のエントリーポイント
    "toolbar-text-resize": "./js/toolbar-text-resize.js", // 新しいエントリーポイント
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
