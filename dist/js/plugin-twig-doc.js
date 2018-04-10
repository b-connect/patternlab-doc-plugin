function modifyPanels() {
  var panelsNew;
  panelsNew = Panels.panels.splice(1,1);
  panelsNew[0].default = true;
  Panels.panels = panelsNew;
}
alert('LOADED');