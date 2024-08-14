(function (blocks, element, blockEditor, components) {
  var el = element.createElement;
  var RichText = blockEditor.RichText;
  var InspectorControls = blockEditor.InspectorControls;
  var PanelBody = components.PanelBody;
  var SelectControl = components.SelectControl;
  var Button = components.Button;
  var Fragment = element.Fragment;

  blocks.registerBlockType("mytheme/comparison-table", {
    title: "比較表",
    icon: "table-col-before",
    category: "zen",
    attributes: {
      tableData: {
        type: "array",
        default: [
          { feature: "特徴1", product1: "", product2: "", product3: "" },
          { feature: "特徴2", product1: "", product2: "", product3: "" },
        ],
      },
      styleClass: {
        type: "string",
        default: "default-style",
      },
      displayOnDesktop: {
        type: "string",
        default: "show",
      },
      displayOnTablet: {
        type: "string",
        default: "show",
      },
      displayOnMobile: {
        type: "string",
        default: "show",
      },
      contentWidth: {
        type: "string",
        default: "100%",
      },
    },
    edit: function (props) {
      var tableData = props.attributes.tableData;
      var styleClass = props.attributes.styleClass;

      function updateFeature(index, value) {
        var newData = tableData.slice();
        newData[index].feature = value;
        props.setAttributes({ tableData: newData });
      }

      function updateProduct1(index, value) {
        var newData = tableData.slice();
        newData[index].product1 = value;
        props.setAttributes({ tableData: newData });
      }

      function updateProduct2(index, value) {
        var newData = tableData.slice();
        newData[index].product2 = value;
        props.setAttributes({ tableData: newData });
      }

      function updateProduct3(index, value) {
        var newData = tableData.slice();
        newData[index].product3 = value;
        props.setAttributes({ tableData: newData });
      }

      function addRow() {
        var newData = tableData.concat({
          feature: "新しい特徴",
          product1: "",
          product2: "",
          product3: "",
        });
        props.setAttributes({ tableData: newData });
      }

      function removeRow(index) {
        var newData = tableData.slice();
        newData.splice(index, 1);
        props.setAttributes({ tableData: newData });
      }

      function onStyleChange(newStyle) {
        props.setAttributes({ styleClass: newStyle });
      }

      return el(
        Fragment,
        {},
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: "比較表設定", initialOpen: true },
            el(SelectControl, {
              label: "スタイル",
              value: styleClass,
              options: [
                { label: "デフォルト", value: "default-style" },
                { label: "シンプル", value: "simple-style" },
                { label: "カラー付き", value: "colored-style" },
              ],
              onChange: onStyleChange,
            })
          ),
          el(
            PanelBody,
            { title: "レスポンシブ設定", initialOpen: false },
            el(SelectControl, {
              label: "デスクトップで表示",
              value: props.attributes.displayOnDesktop,
              options: [
                { label: "表示", value: "show" },
                { label: "非表示", value: "hide" },
              ],
              onChange: (value) => {
                props.setAttributes({ displayOnDesktop: value });
              },
            }),
            el(SelectControl, {
              label: "タブレットで表示",
              value: props.attributes.displayOnTablet,
              options: [
                { label: "表示", value: "show" },
                { label: "非表示", value: "hide" },
              ],
              onChange: (value) => {
                props.setAttributes({ displayOnTablet: value });
              },
            }),
            el(SelectControl, {
              label: "モバイルで表示",
              value: props.attributes.displayOnMobile,
              options: [
                { label: "表示", value: "show" },
                { label: "非表示", value: "hide" },
              ],
              onChange: (value) => {
                props.setAttributes({ displayOnMobile: value });
              },
            })
          ),
          el(
            PanelBody,
            { title: "コンテンツ設定", initialOpen: false },
            el(SelectControl, {
              label: "コンテンツ幅",
              value: props.attributes.contentWidth,
              options: [
                { label: "デフォルト (1100px)", value: "1100px" },
                { label: "幅広 (1400px)", value: "1400px" },
                { label: "全幅 (100%)", value: "100%" },
              ],
              onChange: (value) => props.setAttributes({ contentWidth: value }),
            })
          ),
        ),
        el(
          "div",
          {
            className: [
              "comparison-table",
              styleClass,
              props.attributes.displayOnDesktop === "hide"
                ? "hide-on-desktop"
                : "",
              props.attributes.displayOnTablet === "hide"
                ? "hide-on-tablet"
                : "",
              props.attributes.displayOnMobile === "hide"
                ? "hide-on-mobile"
                : "",
            ]
              .filter(Boolean)
              .join(" "),
              style: {
                maxWidth: props.attributes.contentWidth,
                margin: "0 auto",
              },
          },
          el(
            "table",
            null,
            el(
              "thead",
              null,
              el(
                "tr",
                null,
                el("th", null, "特徴"),
                el("th", null, "製品1"),
                el("th", null, "製品2"),
                el("th", null, "製品3")
              )
            ),
            el(
              "tbody",
              null,
              tableData.map(function (row, index) {
                return el(
                  "tr",
                  { key: index },
                  el(
                    "td",
                    null,
                    el(RichText, {
                      value: row.feature,
                      onChange: function (value) {
                        updateFeature(index, value);
                      },
                      placeholder: "特徴",
                    })
                  ),
                  el(
                    "td",
                    null,
                    el(RichText, {
                      value: row.product1,
                      onChange: function (value) {
                        updateProduct1(index, value);
                      },
                      placeholder: "製品1",
                    })
                  ),
                  el(
                    "td",
                    null,
                    el(RichText, {
                      value: row.product2,
                      onChange: function (value) {
                        updateProduct2(index, value);
                      },
                      placeholder: "製品2",
                    })
                  ),
                  el(
                    "td",
                    null,
                    el(RichText, {
                      value: row.product3,
                      onChange: function (value) {
                        updateProduct3(index, value);
                      },
                      placeholder: "製品3",
                    })
                  ),
                  el(
                    "td",
                    null,
                    el(
                      Button,
                      {
                        isSecondary: true,
                        onClick: function () {
                          removeRow(index);
                        },
                      },
                      "削除"
                    )
                  )
                );
              })
            )
          ),
          el(
            Button,
            {
              isPrimary: true,
              onClick: addRow,
            },
            "行を追加"
          )
        )
      );
    },
    save: function (props) {
      var tableData = props.attributes.tableData;
      var styleClass = props.attributes.styleClass;

      const classes = [
        "comparison-table",
        styleClass,
        props.attributes.displayOnDesktop === "hide" ? "hide-on-desktop" : "",
        props.attributes.displayOnTablet === "hide" ? "hide-on-tablet" : "",
        props.attributes.displayOnMobile === "hide" ? "hide-on-mobile" : "",
      ]
        .filter(Boolean)
        .join(" ");

      return el(
        "div",
        { className: classes,
          style: {
            maxWidth: props.attributes.contentWidth,
            margin: "0 auto",
          },
        },
        el(
          "table",
          null,
          el(
            "thead",
            null,
            el(
              "tr",
              null,
              el("th", null, "特徴"),
              el("th", null, "製品1"),
              el("th", null, "製品2"),
              el("th", null, "製品3")
            )
          ),
          el(
            "tbody",
            null,
            tableData.map(function (row, index) {
              return el(
                "tr",
                { key: index },
                el("td", null, el(RichText.Content, { value: row.feature })),
                el("td", null, el(RichText.Content, { value: row.product1 })),
                el("td", null, el(RichText.Content, { value: row.product2 })),
                el("td", null, el(RichText.Content, { value: row.product3 }))
              );
            })
          )
        )
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor,
  window.wp.components
);
