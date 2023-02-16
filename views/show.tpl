{extends file="layout.tpl"}
{block name=title}Repository{/block}

{block name=content}
    <main class="container-fluid">
        <h1>Repository</h1>
        <dl>
            <dt>Name</dt>
            <dd>{$repository['name']}</dd>
            <dt>Description</dt>
            <dd>{$repository['description']}</dd>
        </dl>
        <a href="/edit/{$repository['full_name']}" class="outline" role="button">Edit</a>
        <a href="/delete/{$repository['full_name']}" class="outline" role="button">Delete</a>
    </main>
{/block}