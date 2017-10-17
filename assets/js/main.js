
(function () {
    // Optimization for Repeat Views
  if (sessionStorage.criticalFoftDataUriFontsLoaded) {
    document.documentElement.className += ' font-initialize fonts-loaded'
    return
  }

  var fontASubset = new FontFaceObserver('WorkSans-Subset')
  var fontBSubset = new FontFaceObserver('Alegreya-Subset')

  Promise.all([fontASubset.load(), fontBSubset.load()]).then(function () {
    document.documentElement.className += ' font-initialize'

    var fontA = new FontFaceObserver('WorkSans')
    var fontB = new FontFaceObserver('WorkSans-Bold')
    var fontC = new FontFaceObserver('WorkSans-ExtraBold')
    var fontD = new FontFaceObserver('Alegreya-Italic')
    var fontE = new FontFaceObserver('Alegreya-BoldItalic')

    Promise.all([fontA.load(), fontB.load(), fontC.load(), fontD.load(), fontE.load()]).then(function () {
      document.documentElement.className += ' fonts-loaded'

        // Optimization for Repeat Views
        sessionStorage.criticalFoftDataUriFontsLoaded = true
    })
  })
})()
