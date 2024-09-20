const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const fs = require('fs');
const path = require('path');

// ブロックディレクトリのパス
const blocksDir = path.resolve(__dirname, 'src/blocks');

// src/blocks ディレクトリ内のすべてのブロックのサブディレクトリを取得
const blockEntries = fs.readdirSync(blocksDir).reduce((entries, dir) => {
    const fullDir = path.join(blocksDir, dir);
    const entryPath = path.join(fullDir, 'index.js');

    // サブディレクトリ内に index.js が存在する場合にエントリーポイントとして追加
    if (fs.statSync(fullDir).isDirectory() && fs.existsSync(entryPath)) {
        // ブロックごとに dist/blocks/blockX/index.js に出力
        entries[`blocks/${dir}/index`] = entryPath;
    }

    return entries;
}, {});

// 管理画面のエントリーポイント
const adminEntry = {
    'admin/admin': './src/admin/admin.js',       // メイン管理画面
    'admin/additional': './src/admin/additional.js', // 追加設定
    'admin/help': './src/admin/help.js',         // 解説ページ
};

// Webpack の設定
module.exports = {
    ...defaultConfig,
    entry: {
        ...blockEntries,  // 動的に取得したブロックのエントリーポイント
        ...adminEntry     // 管理画面のエントリーポイント
    },
    output: {
        path: path.resolve(__dirname, 'dist'), // dist ディレクトリに出力
        filename: '[name].js', // [name] は entry キー (e.g., blocks/block1/index.js)
    },
};
