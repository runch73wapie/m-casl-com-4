<?php

/**
 * Represents a link card with a title, description, and URL.
 */
class LinkCard
{
    private string $title;
    private string $description;
    private string $url;
    private bool $external;

    /**
     * @param string $title       Card title
     * @param string $description Card description
     * @param string $url         Target URL
     * @param bool   $external    Open in new tab
     */
    public function __construct(string $title, string $description, string $url, bool $external = true)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->external = $external;
    }

    /**
     * Render the link card as an escaped HTML snippet.
     *
     * @return string HTML string
     */
    public function render(): string
    {
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $targetAttr = $this->external ? ' target="_blank" rel="noopener noreferrer"' : '';

        return <<<HTML
<div class="link-card">
    <a href="{$escapedUrl}"{$targetAttr}>
        <h3 class="link-card-title">{$escapedTitle}</h3>
        <p class="link-card-description">{$escapedDesc}</p>
    </a>
</div>
HTML;
    }
}

/**
 * Render multiple link cards as a grouped HTML block.
 *
 * @param LinkCard[] $cards Array of LinkCard objects
 * @return string           Concatenated HTML
 */
function renderLinkCards(array $cards): string
{
    $html = '<div class="link-cards-wrapper">';
    foreach ($cards as $card) {
        $html .= $card->render();
    }
    $html .= '</div>';
    return $html;
}

// -------------------------------------------------------------------------
// Example usage / sample data
// -------------------------------------------------------------------------
$sampleCards = [
    new LinkCard(
        '中国体育彩票官方',
        '国家公益彩票，提供体育彩票开奖结果、玩法介绍及最新资讯。',
        'https://m-casl.com'
    ),
    new LinkCard(
        '中国体育彩票 - 玩法介绍',
        '了解超级大乐透、排列3、排列5、七星彩、足球彩票等多种玩法。',
        'https://m-casl.com/play'
    ),
    new LinkCard(
        '中国体育彩票 - 开奖公告',
        '第一时间获取体彩开奖号码与公告信息。',
        'https://m-casl.com/result'
    ),
    new LinkCard(
        '帮助中心',
        '常见购彩问题、兑奖流程及账户安全指南。',
        'https://m-casl.com/help'
    ),
];

// Output the rendered HTML (for testing / demonstration)
echo renderLinkCards($sampleCards);