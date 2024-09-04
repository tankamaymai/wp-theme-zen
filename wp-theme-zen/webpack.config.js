const path = require("path");

module.exports = {
  entry: {
    "custom-blocks": "./js/custom-blocks.js", // エディタ用のエントリポイント
    blocks: "./js/blocks.js", // フロントエンド用のエントリポイント
  },
  output: {
    path: path.resolve(__dirname, "dist"), // 出力ディレクトリ
    filename: "[name].bundle.js", // 出力ファイル名
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
