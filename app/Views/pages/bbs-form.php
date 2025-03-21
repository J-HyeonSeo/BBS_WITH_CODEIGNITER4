
<div id="bbs-title-wrap">
    <input id="bbs-title" name="bbs-title" placeholder="제목을 작성해주세요."/>
</div>

<div class="main-container">
    <div class="editor-container editor-container_classic-editor" id="editor-container">
        <div class="editor-container__editor"><div id="editor"></div></div>
    </div>
</div>

<div class="btn" id="create-bbs-btn" onclick="saveData()">
    등록
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/44.3.0/ckeditor5.umd.js" crossorigin></script>

<script>

    let editor;

    const {
        ClassicEditor,
        Autosave,
        BlockQuote,
        Bold,
        Essentials,
        Heading,
        Indent,
        IndentBlock,
        Italic,
        Link,
        Paragraph,
        Table,
        TableCaption,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        Underline
    } = window.CKEDITOR;

    /**
     * This is a 24-hour evaluation key. Create a free account to use CDN: https://portal.ckeditor.com/checkout?plan=free
     */
    const LICENSE_KEY =
        'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NDI2ODc5OTksImp0aSI6IjJhZDhjMjE3LWNkOGItNDc4YS1hNTQ0LWNjYjlhMGQ0MDE0NyIsImxpY2Vuc2VkSG9zdHMiOlsiKi53ZWJjb250YWluZXIuaW8iLCIqLmpzaGVsbC5uZXQiLCIqLmNzcC5hcHAiLCJjZHBuLmlvIiwiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIiwic2giXSwibGljZW5zZVR5cGUiOiJldmFsdWF0aW9uIiwidmMiOiIwYzYxNWZiZSJ9.O-dw0DgVvYPB5GJqiFqZbfKdMKpF_0fHHcRPfP_S5uZITwrO7788Koa0upfOBO270YC_A-NCmVdUccSNTxEp1Q';

    const editorConfig = {
        toolbar: {
            items: ['heading', '|', 'bold', 'italic', 'underline', '|', 'link', 'insertTable', 'blockQuote', '|', 'outdent', 'indent'],
            shouldNotGroupWhenFull: true
        },
        plugins: [
            Autosave,
            BlockQuote,
            Bold,
            Essentials,
            Heading,
            Indent,
            IndentBlock,
            Italic,
            Link,
            Paragraph,
            Table,
            TableCaption,
            TableCellProperties,
            TableColumnResize,
            TableProperties,
            TableToolbar,
            Underline
        ],
        heading: {
            options: [
                {
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Heading 1',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Heading 2',
                    class: 'ck-heading_heading2'
                },
                {
                    model: 'heading3',
                    view: 'h3',
                    title: 'Heading 3',
                    class: 'ck-heading_heading3'
                },
                {
                    model: 'heading4',
                    view: 'h4',
                    title: 'Heading 4',
                    class: 'ck-heading_heading4'
                },
                {
                    model: 'heading5',
                    view: 'h5',
                    title: 'Heading 5',
                    class: 'ck-heading_heading5'
                },
                {
                    model: 'heading6',
                    view: 'h6',
                    title: 'Heading 6',
                    class: 'ck-heading_heading6'
                }
            ]
        },
        initialData:
            '',
        licenseKey: LICENSE_KEY,
        link: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'https://',
            decorators: {
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        placeholder: '여기에 내용을 작성해주세요.',
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
        }
    };

    ClassicEditor.create(document.querySelector('#editor'), editorConfig)
        .then( newEditor => {
            editor = newEditor;
        })
        .catch( error => {
            console.error("Something went wrong!");
        });

    function saveData() {

        const bbsTitle = document.getElementById("bbs-title").value.trim();
        const content = editor.getData();

        if (bbsTitle === null || bbsTitle === '') {
            alert("게시글 제목을 작성해주세요.");
            return;
        }

        if (bbsTitle.length > 30) {
            alert("게시글 제목은 30 자 이내로 작성해주세요.");
            return;
        }

        if (content === null || content === '') {
            alert("게시글 내용을 작성해주세요.");
            return;
        }

        if (content.length > 4000) {
            alert("게시글 내용은 4000자 이내로 작성해주세요.");
            return;
        }

        fetch("/bbs", {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "<?= csrf_header() ?>": "<?= csrf_hash() ?>"
            },
            body: JSON.stringify({
                'bbs-title': bbsTitle,
                'content': content
            })
        }).then(response => {
                if (response.status === 200) {
                    window.location.href = "/";
                }
            })
            .catch(error => {
                console.error(error);
                alert("게시글 작성 중 오류가 발생하였습니다.");
            });

    }

</script>