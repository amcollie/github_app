{extends file="layout.tpl"}
{block name=title}Update Repository{/block}

{block name=content}
    <main class="container-fluid">
        <h1>Update Repository</h1>
        <p>Repository updated successfully</p>
        <a href="/show/{$repository['full_name']}" class="outline" role="button">Show</a>
    </main>
{/block}