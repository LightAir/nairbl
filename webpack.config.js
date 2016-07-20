module.exports = {
  // the main entry of our app
  entry: './assets_src/js/main.js',
  // output configuration
  output: {
    path: __dirname + '/build/',
    publicPath: 'build/',
    filename: 'main.js'
  },
  // how modules should be transformed
  module: {
    loaders: [
      // process *.vue files using vue-loader
      { test: /\.vue$/, loader: 'vue' },
      // process *.js files using babel-loader
      // the exclude pattern is important so that we don't
      // apply babel transform to all the dependencies!
      { test: /\.js$/, loader: 'babel', exclude: /node_modules/ },
      // scss
      { test: /\.scss/, loader: 'style!css!sass' },
      { test: /\.css/, loader: 'style!css!sass' },
      // json
      { test: /\.json/, loader: 'json' }
    ]
  },
  // configure babel-loader.
  // this also applies to the JavaScript inside *.vue files
  babel: {
    presets: ['es2015'],
    plugins: ['transform-runtime']
  }
}
