import { 
    render
} from '@wordpress/element';
import PageNavigation from './navigation';

const HelpPage = () => {
    return (
        <div className="smtrm-admin-wrapper">
            <div className="admin-content">
                <h1>Same Term Pager 設定</h1>
                <h2>ヘルプ</h2>
                <p>このページでは、Same Term Pagerの設定について説明します。</p>
                <p>詳しい使い方については公式ドキュメントをご参照ください。</p>
            </div>
            {/* 右カラム（ナビゲーション） */}
            <PageNavigation />
        </div>
    );
};

// エントリーポイントにレンダリング
render(<HelpPage />, document.getElementById('smtrm-pager-help'));