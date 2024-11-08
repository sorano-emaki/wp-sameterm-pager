import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';  // WordPressの翻訳機能を使用
import {
    ToggleControl,
} from '@wordpress/components';
import { 
    render
} from '@wordpress/element';
import PageNavigation from './components/Navigation';
import GettingStarted from './help/GettingStarted'; // Additional component // 追加のコンポーネント
import SettingMenu from './help/SettingMenu'; // Additional component // 追加のコンポーネント
import PagerAdditionManual from './help/PagerAdditionManual'; // Additional component // 追加のコンポーネント
import PluginInfo from './help/PluginInfo'; // Additional component // 追加のコンポーネント
import FrequentlyAskedQuestions from './help/FrequentlyAskedQuestions'; // Additional component // 追加のコンポーネント

const HelpPage = () => {
    const [activeTab, setActiveTab] = useState('GettingStarted'); // Tab state management // タブの状態管理

    const renderContent = () => {
        switch (activeTab) {
            case 'GettingStarted':
                return <GettingStarted />;
            case 'settingMenu':
                return <SettingMenu />;
            case 'pagerAddition':
                return <PagerAdditionManual />; // Content for adding a pager // ページャー追加方法のコンテンツ
            case 'faq':
                return <FrequentlyAskedQuestions />;
            case 'pluginInfo':
                return <PluginInfo />; // Content about the plugin // プラグインについてのコンテンツ
            default:
                return null;
        }
    };

    return (
        <div className="smtrm-admin-wrapper">
            <div className="admin-content">
                {/* Tab navigation */}
                {/* タブナビゲーション */}
                <div className="tab-navigation">
                    <button onClick={() => setActiveTab('GettingStarted')} className={activeTab === 'GettingStarted' ? 'active' : ''}>
                        { __('Getting Started','wp-sameterm-pager') }
                    </button>
                    <button onClick={() => setActiveTab('settingMenu')} className={activeTab === 'settingMenu' ? 'active' : ''}>
                        { __('Setting Menu','wp-sameterm-pager') }
                    </button>
                    <button onClick={() => setActiveTab('pagerAddition')} className={activeTab === 'pagerAddition' ? 'active' : ''}>
                        { __('Adding a Pager', 'wp-sameterm-pager') }
                    </button>
                    <button onClick={() => setActiveTab('faq')} className={activeTab === 'faq' ? 'active' : ''}>
                        { __('Frequently Asked Questions', 'wp-sameterm-pager') }
                    </button>
                    <button onClick={() => setActiveTab('pluginInfo')} className={activeTab === 'pluginInfo' ? 'active' : ''}>
                        { __('About this Plugin', 'wp-sameterm-pager') }
                    </button>
                </div>

                {/* Content display area */}
                {/* コンテンツの表示エリア */}
                <div className="tab-content">
                    {renderContent()}
                </div>
            </div>

            {/* Right column (navigation) */}
            {/* 右カラム（ナビゲーション） */}
            <PageNavigation />
        </div>
    );
};

// Render the entry point
// エントリーポイントにレンダリング
render(<HelpPage />, document.getElementById('smtrm-pager-help'));
