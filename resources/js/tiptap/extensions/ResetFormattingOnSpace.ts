import { Extension } from '@tiptap/core'

const ResetFormattingOnSpace = Extension.create({
    name: 'resetFormattingOnSpace',

    addKeyboardShortcuts() {
        return {
            'Space': () => {
                const { selection } = this.editor.state
                if (selection.empty) {
                    this.editor
                        .chain()
                        .focus()
                        .unsetBold()
                        .unsetItalic()
                        .unsetCode()
                        .unsetUnderline()
                        .unsetStrike()
                        .insertContent(' ')
                        .run()
                    return true
                }
                return false
            },
        }
    },
})

export default ResetFormattingOnSpace
