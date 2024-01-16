
<template>
    <div class="editor-bg">
        <div ref="quillEditor"></div>
    </div>
</template>


  
<script>

// Import necessary libraries
import { ref, reactive } from 'vue';
import Quill from 'quill';
import QuillMention from 'quill-mention';
import { useStore } from 'vuex';  // Assuming you are using Vuex

// Import styles for Quill editor
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';
import hljs from 'highlight.js';

import 'highlight.js/styles/default.css'; // Replace 'default' with the style you prefer

// Register Quill Mention
Quill.register('modules/mention', QuillMention);
// const CodeBlock = Quill.import('formats/code');
Quill.register('modules/syntax', function (quill, options) {
    let isFormatting = true; // Add a flag to prevent recursive calls
    quill.on('text-change', function () {
        if (!isFormatting) {
            isFormatting = true;
            quill.formatText(0, quill.getLength(), 'code-block', false);
            quill.formatLine(0, quill.getLength(), 'code-block', true);
            quill.getLines().forEach((line, index) => {
                hljs.highlightBlock(quill.getLine(index));
            });

            isFormatting = false;
        }
    });
});


export default {

    name: 'Editor',
    props: {
        modelValue: {
            type: String,
            required: true,
        },
    },
    mounted() {
        this.initializeQuill();
        this.highlightCode();
    },
    updated() {
        this.highlightCode();
    },
    setup() {
        
        const content = ref('');
        const store = useStore();
        const mentionConfig = reactive({
            allowedChars: /^[A-Za-z\sÅÄÖåäö]*$/,
            mentionDenotationChars: ['@'],
            source: async function (searchTerm, renderList, mentionChar) {
                try {

                    const response = await store.dispatch('users/users', searchTerm);
                    const users = response.data.data;
                    if (users) {

                        const matches = users.map((user) => ({
                            id: user.id,
                            value: user.name,
                            display: user.name,
                        }));

                        renderList(matches, searchTerm);
                    }
                } catch (error) {
                    console.error('Error fetching users:', error);
                }
            },
        });

        return { content, mentionConfig };
    },

    methods: {
        initializeQuill() {
            this.quill = new Quill(this.$refs.quillEditor, {
                theme: 'snow',
                modules: {
                    syntax: true, // Enable syntax highlighting module
                    mention: this.mentionConfig, // Add mention module
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

            this.quill.on('text-change', () => {
                this.$emit('update:modelValue', this.quill.root.innerHTML);
            });
        },
        highlightCode() {
            const codeBlocks = this.$el.querySelectorAll('pre code');
            codeBlocks.forEach((block) => {
                hljs.highlightBlock(block);
            });
        },

    },
};
</script>
<style scoped>
.editor-bg {
    background-color: white;
}
</style>
  