
<template>
    <div class="editor-bg">
        <div ref="quillEditor"></div>
    </div>
</template>


  
<script>

// Import necessary libraries
import VueQuillEditor from 'vue-quill-editor';
import Quill from 'quill';
import QuillMention from 'quill-mention';

// Import styles for Quill editor
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';

import hljs from 'highlight.js';

import 'highlight.js/styles/default.css'; // Replace 'default' with the style you prefer



// Register Quill Mention
Quill.register('modules/mention', QuillMention);


const CodeBlock = Quill.import('formats/code');
CodeBlock.tagName = 'PRE';
Quill.register(CodeBlock, true);

Quill.register('modules/syntax', function (quill, options) {
  quill.on('text-change', function () {
    quill.formatText(0, quill.getLength(), 'code-block', false);
    quill.formatLine(0, quill.getLength(), 'code-block', true);
    quill.getLines().forEach((line, index) => {
      hljs.highlightBlock(quill.getLine(index));
    });
  });
});


export default {
    name: 'Editor',
    mounted() {
        this.initializeQuill();
      //  this.highlightCode();
    },

    updated() {
      //  this.highlightCode();
    },
    methods: {
        initializeQuill() {
            this.quill = new Quill(this.$refs.quillEditor, {
                theme: 'snow',
                modules: {
                     syntax: true, // Enable syntax highlighting module
                    toolbar: [
                        // Add other toolbar buttons as needed
                         [{ header: [1, 2, false] }],
                         ['bold', 'italic', 'underline', 'strike'],
                         ['blockquote', 'code-block'],
                         [{ list: 'ordered' }, { list: 'bullet' }],
                        // [{ script: 'sub' }, { script: 'super' }],
                        // ['link', 'image'],
                        // [{ 'color': [] }, { 'background': [] }],
                        // ['clean'],
                    ],
                },
                placeholder: 'Write your code here...',
            });
        },
        highlightCode() {
            const codeBlocks = this.$el.querySelectorAll('pre code');
            codeBlocks.forEach((block) => {
                hljs.highlightBlock(block);
            });
        },
    },
    data() {
        return {
            content: '',
            mentionConfig: {
                allowedChars: /^[A-Za-z\sÅÄÖåäö]*$/,
                mentionDenotationChars: ['@'],
                source: function (searchTerm, renderList, mentionChar) {
                    // Implement your logic to fetch and filter users based on the searchTerm
                    const users = [
                        { id: 1, value: 'user1', display: 'User 1' },
                        { id: 2, value: 'user2', display: 'User 2' },
                        // Add more users as needed
                    ];

                    const matches = users.filter((user) => {
                        return user.display.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1;
                    });

                    renderList(matches, searchTerm);
                },
            },
        };
    },
};
</script>
<style scoped>
.editor-bg {
    background-color: white;
}
</style>
  