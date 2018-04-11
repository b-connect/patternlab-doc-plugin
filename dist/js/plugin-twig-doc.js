
var TwigDocPlugin = {

	insert: function(panels, patternData, iframePassback, switchText) {
    console.log(panels);
    $(panels).find('#sg-atoms-colors-pl-panel-variables-panel').append('<pre class="language-markup"><table border=1><tr><td>HERE</td><td>HERE</td></tr></table></pre>');
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