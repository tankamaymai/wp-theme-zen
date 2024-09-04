(function (wp) {
  const { registerBlockStyle } = wp.blocks;

  const styles = [
    {
      name: "custom-style-1",
      label: wp.element.createElement(
        "span",
        { className: "fas fa-check-circle" },
        ""
      ),
    },
    {
      name: "custom-style-2",
      label: wp.element.createElement("span", { className: "fas fa-star" }, ""),
    },
    {
      name: "custom-style-3",
      label: wp.element.createElement(
        "span",
        { className: "fas fa-arrow-right" },
        ""
      ),
    },
    {
      name: "custom-style-4",
      label: wp.element.createElement(
        "span",
        { className: "fas fa-caret-right" },
        ""
      ),
    },
    {
      name: "custom-style-5",
      label: wp.element.createElement(
        "span",
        { className: "fas fa-chevron-right" },
        ""
      ),
    },
    {
      name: "custom-style-6",
      label: wp.element.createElement(
        "span",
        { className: "fas fa-hand-point-right" },
        ""
      ),
    },
  ];

  styles.forEach((style) => {
    registerBlockStyle("core/list", style);
  });
})(window.wp);
