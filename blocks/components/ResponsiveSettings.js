const ResponsiveSettings = (props) => {
  return el(
    PanelBody,
    { title: "表示設定", initialOpen: false },
    el(SelectControl, {
      label: "デスクトップで表示",
      value: props.attributes.displayOnDesktop,
      options: [
        { label: "表示", value: true },
        { label: "非表示", value: false },
      ],
      onChange: (value) =>
        props.setAttributes({ displayOnDesktop: value === true }),
    }),
    el(SelectControl, {
      label: "タブレットで表示",
      value: props.attributes.displayOnTablet,
      options: [
        { label: "表示", value: true },
        { label: "非表示", value: false },
      ],
      onChange: (value) =>
        props.setAttributes({ displayOnTablet: value === true }),
    }),
    el(SelectControl, {
      label: "モバイルで表示",
      value: props.attributes.displayOnMobile,
      options: [
        { label: "表示", value: true },
        { label: "非表示", value: false },
      ],
      onChange: (value) =>
        props.setAttributes({ displayOnMobile: value === true }),
    })
  );
};
