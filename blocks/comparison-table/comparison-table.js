(function (blocks, element, blockEditor, components) {
  var el = element.createElement;
  var RichText = blockEditor.RichText;
  var InspectorControls = blockEditor.InspectorControls;
  var PanelBody = components.PanelBody;
  var SelectControl = components.SelectControl;
  var Button = components.Button;
  var Fragment = element.Fragment;
  var AlignmentToolbar = blockEditor.AlignmentToolbar;
  var BlockControls = blockEditor.BlockControls;

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
      alignment: {
        type: "string",
        default: "left",
      },
    },
    edit: function (props) {
      var tableData = props.attributes.tableData;
      var styleClass = props.attributes.styleClass;

      function onChangeAlignment(newAlignment) {
        props.setAttributes({ alignment: newAlignment === undefined ? "center" : newAlignment });
      }

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
          BlockControls,
          null,
          el(AlignmentToolbar, {
            value: props.attributes.alignment,
            onChange: onChangeAlignment,
          })
        ),
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
              __nextHasNoMarginBottom: true,
            })
          )
        ),
        el(
          "div",
          {
            className: [
              "comparison-table",
              styleClass,
            ]
              .filter(Boolean)
              .join(" "),
            style: {
              textAlign: props.attributes.alignment,
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
      ]
        .filter(Boolean)
        .join(" ");

      return el(
        "div",
        {
          className: classes,
          style: {
            textAlign: props.attributes.alignment,
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
                el("td", null, el(RichText.Content, { tagName: "span", value: row.feature })),
                el("td", null, el(RichText.Content, { tagName: "span", value: row.product1 })),
                el("td", null, el(RichText.Content, { tagName: "span", value: row.product2 })),
                el("td", null, el(RichText.Content, { tagName: "span", value: row.product3 }))
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