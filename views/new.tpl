{extends file="layout.tpl"}

{block name=title}New Repository{/block}

{block name=content}
    <main class="container-fluid">
        <h1>New Repository</h1>

        <form method="post" action="/create">
            <label for="name">Repository Name</label>
            <input type="text" name="name" />

            <label for="description">Repository Description</label>
            <textarea name="description"> </textarea>

            <button class="outline" type="submit">Create Repository</button>
        </form>
    </main>
{/block}