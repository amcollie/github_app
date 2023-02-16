{extends file="layout.tpl"}
{block name=title}Repositories{/block}

{block name=content}
    <main class="container-fluid">
        <h1>Repositories</h1>
        <table role="grid">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                {foreach $repositories as $repository}
                    <tr>
                        <td>
                            <a href="show/{$repository['full_name']}">
                                {$repository['name']}
                            </a>
                        </td>
                        <td>{$repository['description']}</td>
                    </tr> 
                {/foreach}
            </tbody>
        </table>

        <a href="/new" class="outline" role="button">Create Repository</a>
    </main>
{/block}