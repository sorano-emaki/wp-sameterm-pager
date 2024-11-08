import { __ } from '@wordpress/i18n';  // WordPressの翻訳機能を使用
import { useEffect, useState } from '@wordpress/element';

const PluginInfo = () => {
    const [pluginData, setPluginData] = useState({
        name: '',
        uri: '',
        description: '',
        version: '',
        author: '',
        authorUri: '',
        requiresWP: '',
        requiresPHP: ''
    });

    useEffect(() => {
        if (typeof wpSametermPluginInfo !== 'undefined') {
            setPluginData(wpSametermPluginInfo);
        }
    }, []);

    return (
        <div>
            <h1>{ __('About This Plugin', 'wp-sameterm-pager') }</h1>
            <p>{ __('For developer information and updates, please refer to the official website.', 'wp-sameterm-pager') }</p>
            
            <div className="smtrm-info">
                <table>
                    <tbody>
                        <tr>
                            <th>{ __('Plugin Name:', 'wp-sameterm-pager') }</th>
                            <td>{ pluginData.name }</td>
                        </tr>
                        <tr>
                            <th>{ __('Plugin URI:', 'wp-sameterm-pager') }</th>
                            <td><a href={ pluginData.uri }>{ pluginData.uri }</a></td>
                        </tr>
                        <tr>
                            <th>{ __('Description:', 'wp-sameterm-pager') }</th>
                            <td>{ pluginData.description }</td>
                        </tr>
                        <tr>
                            <th>{ __('Version:', 'wp-sameterm-pager') }</th>
                            <td>{ pluginData.version }</td>
                        </tr>
                        <tr>
                            <th>{ __('Author:', 'wp-sameterm-pager') }</th>
                            <td dangerouslySetInnerHTML={{ __html: pluginData.author }}></td>
                        </tr>
                        <tr>
                            <th>{ __('Author URI:', 'wp-sameterm-pager') }</th>
                            <td><a href={ pluginData.authorUri }>{ pluginData.authorUri }</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <section className='smtrm-system'>
                <h2>{ __('System Requirements', 'wp-sameterm-pager') }</h2>
                <ul>
                    <li><span>{ __('WordPress Version:', 'wp-sameterm-pager')}</span><span>{ pluginData.requiresWP }{ __(' or higher', 'wp-sameterm-pager') }</span></li>
                    <li><span>{ __('PHP Version:', 'wp-sameterm-pager')}</span><span>{ pluginData.requiresPHP }{ __(' or higher', 'wp-sameterm-pager') }</span></li>
                </ul>
            </section>
        </div>

    );
};

export default PluginInfo;
