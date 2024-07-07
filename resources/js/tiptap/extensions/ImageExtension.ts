import { Node, mergeAttributes, nodeInputRule, Command } from '@tiptap/core'

const IMAGE_INPUT_REGEX = /!\[(.+|:?)]\((\S+)(?:(?:\s+)["'](\S+)["'])?\)/

export const ImageExtension = Node.create({
    name: 'image',
    group: 'inline',
    inline: true,
    selectable: true,
    draggable: true,
    addAttributes() {
        return {
            src: {
                default: null,
            },
            alt: {
                default: null,
            },
        }
    },
    parseHTML() {
        return [
            {
                tag: 'img',
                getAttrs: (dom) => ({
                    src: dom.getAttribute('src'),
                    alt: dom.getAttribute('alt'),
                }),
            },
        ]
    },
    renderHTML({ HTMLAttributes }) {
        return ['img', mergeAttributes(HTMLAttributes)]
    },
    addCommands() {
        return {
            setImage: (options) =>
                ({ commands }) => {
                    return commands.insertContent({
                        type: this.name,
                        attrs: options,
                    })
                },
        }
    },
    addInputRules() {
        return [
            nodeInputRule({
                find: IMAGE_INPUT_REGEX,
                type: this.type,
                getAttributes: (match) => {
                    const [, alt, src] = match
                    return { src, alt }
                },
            }),
        ]
    },
})
