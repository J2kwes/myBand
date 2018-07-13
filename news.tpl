
<div id="news-container">
    <h3>Current page: {$current_page}</h3>

    <h3>Number of pages is: {$number_of_pages}</h3>

    {if $current_page gt 1}
        <a href="index.php?page=news&pageno={$current_page - 1}">Previous</a>
    {/if}

    {if $current_page lt $number_of_pages}
        <a href="index.php?page=news&pageno={$current_page + 1}">Next</a>
    {/if}

    <div id="article-container">
        {foreach from=$articles item=article}
           <h2 class="title">{$article[0]}</h2>
           <p class="content">{$article[1]}</p>
           <img src="{$article[2]}" alt="f  oobar" class="images"/>
        {/foreach}
    </div>
</div>
