{extends file="layout.tpl"}
{block name=title}New Repository{/block}

{block name=content}
    <main class="container-fluid">
        <h1>New Repository</h1>
        <p>Repository created successfully</p>
        <a href="/show/{$repository['full_name']}" class="outline" role="button">Show</a>
    </main>
{/block}