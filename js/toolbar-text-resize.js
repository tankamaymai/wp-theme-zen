(function (wp) {
  const { BlockControls } = wp.blockEditor;
  const { ToolbarGroup, ToolbarButton, Dropdown } = wp.components;
  const { addFilter } = wp.hooks;
  const { createElement } = wp.element;

  const withFontSizeToolbarButton = wp.compose.createHigherOrderComponent(
    (BlockEdit) => {
      return (props) => {
        if (props.name !== "core/paragraph") {
          return createElement(BlockEdit, props);
        }

        const applyFontSizeClass = (className) => {
          let newClassName = props.attributes.className || "";

          // `small-font`, `large-font`, `huge-font`のクラスをすべて削除
          newClassName = newClassName
            .replace(/\bsmall-font\b|\blarge-font\b|\bhuge-font\b/g, "")
            .trim();

          // 新しいクラスを追加
          if (className) {
            newClassName += " " + className;
          }

          props.setAttributes({ className: newClassName.trim() });
        };

        return createElement(
          wp.element.Fragment,
          {},
          createElement(BlockEdit, props),
          createElement(
            BlockControls,
            {},
            createElement(
              ToolbarGroup,
              {},
              createElement(Dropdown, {
                renderToggle: ({ isOpen, onToggle }) =>
                  createElement(ToolbarButton, {
                    icon: "editor-textcolor",
                    label: "フォントサイズ",
                    onClick: onToggle,
                    "aria-expanded": isOpen,
                  }),
                renderContent: () =>
                  createElement(
                    "div",
                    {
                      style: {
                        padding: "10px",
                        display: "flex",
                        flexDirection: "column",
                        gap: "10px",
                      },
                    },
                    createElement(
                      ToolbarButton,
                      {
                        isSecondary: true,
                        onClick: () => applyFontSizeClass("small-font"),
                        isActive:
                          props.attributes.className &&
                          props.attributes.className.includes("small-font"),
                      },
                      "小サイズ"
                    ),
                    createElement(
                      ToolbarButton,
                      {
                        isSecondary: true,
                        onClick: () => applyFontSizeClass(""),
                        isActive: !(
                          props.attributes.className &&
                          (props.attributes.className.includes("small-font") ||
                            props.attributes.className.includes("large-font") ||
                            props.attributes.className.includes("huge-font"))
                        ),
                      },
                      "中サイズ"
                    ),
                    createElement(
                      ToolbarButton,
                      {
                        isSecondary: true,
                        onClick: () => applyFontSizeClass("large-font"),
                        isActive:
                          props.attributes.className &&
                          props.attributes.className.includes("large-font"),
                      },
                      "大サイズ"
                    ),
                    createElement(
                      ToolbarButton,
                      {
                        isSecondary: true,
                        onClick: () => applyFontSizeClass("huge-font"),
                        isActive:
                          props.attributes.className &&
                          props.attributes.className.includes("huge-font"),
                      },
                      "特大サイズ"
                    )
                  ),
              })
            )
          )
        );
      };
    },
    "withFontSizeToolbarButton"
  );

  addFilter(
    "editor.BlockEdit",
    "mytheme/add-font-size-toolbar-button",
    withFontSizeToolbarButton
  );
})(window.wp);
