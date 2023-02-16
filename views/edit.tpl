{extends file="layout.tpl"}
{block name=title}Repository{/block}

{block name=content}
    <main class="container-fluid">
        <h1>Edit Repository</h1>
        <form method="post" action="/save">
            <label for="name">Name</label>
            <input name="name" value={$repository['name']}>
            <label for="description">Description</label>
            <textarea name="description">{$repository['description']}</textarea>
            <input type="hidden" name="full_name" value={$repository["full_name"]}>
            <button type="submit" class="outline">Update</button>
        </form>
    </main>
{/block}