(function (blocks, element, editor) {
  const { registerBlockType } = blocks;
  const { createElement: el } = element;
  const { InspectorControls } = editor;

  registerBlockType("ananta/diamond-block", {
    title: "Diamond Showcase",
    icon: "admin-generic",
    category: "widgets",

    edit: function () {
      return el(
        "p",
        null,
        "Diamond Showcase Block (will show random 6 diamonds on frontend)."
      );
    },

    save: function () {
      return null; // Rendered by PHP
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
