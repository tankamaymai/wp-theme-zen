const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
  ...defaultConfig,
  entry: {
    blocks: "./js/blocks.jsx",
    newBlocks: "./src/index.js",  // FAQブロック用のエントリーポイント
    "toolbar-text-resize": "./js/toolbar-text-resize.jsx",
    "custom-block-margin-padding": "./js/custom-block-margin-padding.jsx",  // パスを修正
    "responsive": "./js/responsive.jsx",
    "content-with": "./js/content-with.jsx",
    "icon-picker": "./js/icon-picker.jsx",
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name].bundle.js',
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,  // .jsx も対象に
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              '@babel/preset-env',
              '@babel/preset-react'
            ],
            plugins: [
              '@babel/plugin-transform-react-jsx'
            ]
          }
        }
      }
    ]
  },
  resolve: {
    extensions: ['.js', '.jsx']  // .jsx を追加
  },
  externals: {
    '@wordpress/element': 'wp.element',
    '@wordpress/blocks': 'wp.blocks',
    '@wordpress/editor': 'wp.editor',
    '@wordpress/components': 'wp.components',
    '@wordpress/i18n': 'wp.i18n',
    '@wordpress/compose': 'wp.compose',
    '@wordpress/data': 'wp.data',
    '@wordpress/block-editor': 'wp.blockEditor'
  }
};