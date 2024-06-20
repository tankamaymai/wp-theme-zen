const path = require("path");

module.exports = {
  entry: "./js/custom-blocks.js", // ソースファイル
  output: {
    path: path.resolve(__dirname, "js"), // 出力ディレクトリ
    filename: "custom-blocks.js", // 出力ファイル名
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
};
