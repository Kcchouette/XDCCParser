<ul class="forwards">
	{foreach from=$bots item=bot}
		<li><a href="?nick={$bot.nick}">{$bot.nick}</a></li>
	{/foreach}
</ul>
