(function (blocks, element, blockEditor) {
  var el = element.createElement;
  var InnerBlocks = blockEditor.InnerBlocks;

  blocks.registerBlockType("mytheme/fullwidth", {
    title: "フルワイド",
    icon: "align-wide",
    category: "zen",
    supports: {
      align: ["full"],
    },

    edit: function () {
      return el(
        "div",
        { className: "fullwidth-container" },
        el(InnerBlocks, {
          templateLock: false,
        })
      );
    },

    save: function () {
      return el(
        "div",
        { className: "fullwidth-container" },
        el(InnerBlocks.Content)
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
