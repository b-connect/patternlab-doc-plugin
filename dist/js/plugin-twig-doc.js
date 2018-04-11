
var TwigDocPlugin = {

	insert: function(panels, patternData, iframePassback, switchText) {
    // console.log(panels);
    var id = '#sg-' + patternData + '-pl-panel-variables-panel'
    $(panels).find(id).html('<pre class="language-markup"></pre>');
    var table = $(panels).find('table.variables').remove();
    $(panels).find(id).find('pre').append(table);
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