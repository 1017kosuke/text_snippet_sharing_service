<style>
#editor {
    width: 100%;
    height: 500px;
    border: 1px solid #ccc;
}
</style>

<div class="snippet-container">
    <div id="editor"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs/loader.js"></script>
<script>
let editor;
let language = <?= json_encode($text['lang'] ?? 'plaintext') ?>;
let theme = "vs";
let content = <?= json_encode($text['content'] ?? '') ?>;

require.config({
    paths: {
        'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs'
    }
});

require(['vs/editor/editor.main'], function () {
    const editorElement = document.getElementById('editor');
    if (!editorElement) {
        console.error('editor element not found');
        return;
    }

    const languageSelect = document.getElementById('language');
    if (languageSelect) {
        languageSelect.value = language;
    }

    editor = monaco.editor.create(editorElement, {
        value: content || '// No content',
        language: language,
        theme: theme,
        automaticLayout: true,
    });
});
</script>

<!-- Add a button to create a link to the snippet -->
<script>
async function createLink() {
    if (!editor) return;

    const content = editor.getValue();
    const lang = document.getElementById('language').value;
    const uniqueString = new URLSearchParams(window.location.search).get('unique-string') || null;

    const response = await fetch('/api/snippet', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ content, lang, uniqueString })
    });

    const data = await response.json();


    if (data.error) {
        alert(data.error);
        return;
    }

    const url = `${window.location.origin}/snippet?unique-string=${data.unique_string}`;
    await navigator.clipboard.writeText(url);
    alert('Link copied to clipboard!');
}
</script>

<div class="d-flex justify-content-between mt-3">
    <div class="d-flex align-items-center">
        <lable for="language">Language:</lable>
        <select id="language" onchange="monaco.editor.setModelLanguage(editor.getModel(), this.value)">
            <option value="plaintext">Plain Text</option>
            <option value="python">Python</option>
            <option value="javascript">JavaScript</option>
            <option value="java">Java</option>
            <option value="csharp">C#</option>
            <option value="cpp">C++</option>
            <option value="ruby">Ruby</option>
        </select>   
    </div>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" onclick="createLink()">
            Create Link
        </button>
    </div>
</div>
