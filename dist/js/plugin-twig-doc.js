
var TwigDocPlugin = {

	insert: function(panels, patternData, iframePassback, switchText) {
    $(panels).find('#sg-atoms-colors-pl-panel-variables-panel').html('HERE');
  },

}

Panels.add({
	'id': 'pl-panel-variables',
	'name': 'Variables',
	'default': false,
	'templateID': 'pl-panel-template-code',
	'httpRequest': true,
	'httpRequestReplace': fileSuffixMarkup + '.html',
	'httpRequestCompleted': false,
	'prismHighlight': true,
	'language': 'markup',
  'keyCombo': 'ctrl+shift+y'
})