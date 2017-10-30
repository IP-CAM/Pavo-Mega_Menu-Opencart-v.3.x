const path = require( 'path' );
const webpack = require( 'webpack' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );

module.exports = [
	{
		entry: {
			'upload/admin/view/stylesheet/pavomenu/dist/pavomenu': path.join( __dirname, 'upload/admin/view/stylesheet/pavomenu/pavomenu.scss' ),
			'upload/catalog/view/theme/default/stylesheet/pavomenu': path.join( __dirname, 'upload/catalog/view/theme/default/stylesheet/pavomenu/pavomenu.scss' ),
		},
		output: {
			filename: "[name].min.css",
			path: path.join( __dirname, '' )
		},
		module: {
			loaders: [
				{
					test: /\.css$/,
					loader: [ 'style-loader', 'css-loader' ]
				},
				{
					test: /\.scss$/,
					exclude: /node_modules/,
					loader: ExtractTextPlugin.extract([ 'css-loader?minimize', 'sass-loader' ])
				},
				{
					// image extensions, fonts extensions
					test: /\.(png|jpg|jpeg|ttf|woff|woff2|eot|svg|gif|)$/,
					exclude: /node_modules/,
					loader: [ 'url-loader?emitFile=false' ]
				}
			]
		},
		devtool: 'eval-source-map',
	 	stats: {
	     	colors: true
	 	},
		plugins: [
		    new ExtractTextPlugin({
			    filename: "[name].min.css",
			    disable: process.env.NODE_ENV === 'development'
			})
		]
	},
	{
		entry: {
			'upload/admin/view/javascript/pavomenu/dist/pavomenu': path.join( __dirname, 'upload/admin/view/javascript/pavomenu/pavomenu.js' ),
			'upload/catalog/view/javascript/pavomenu': path.join( __dirname, 'upload/catalog/view/javascript/pavomenu/pavomenu.js' ),
		},
		output: {
			filename: "[name].min.js",
			path: path.join( __dirname, '' )
		},
		module: {
			loaders: [
				{
					test: /\.css$/,
					loader: [ 'style-loader', 'css-loader' ]
				},
				{
					test: /\.js$/,
					exclude: /node_modules/,
					loader: 'babel-loader',
					query: {
						presets: [ 'es2015', 'stage-0' ]
					}
				}
			]
		},
		devtool: 'eval-source-map',
		plugins: [
			new webpack.DefinePlugin({
		      	'process.env.NODE_ENV': JSON.stringify( process.env.NODE_ENV )
		    }),
		    new webpack.optimize.OccurrenceOrderPlugin(),
		    new webpack.optimize.UglifyJsPlugin({
		      	compress: { warnings: false },
		      	mangle: true,
		      	sourcemap: true,
		      	beautify: false,
		      	dead_code: true
		    })
		],
		resolve: {
			extensions: [ '.js', '.css' ],
			alias: {
				'jquery-ui': 'jquery-ui/ui'
			}
		}
	}
]