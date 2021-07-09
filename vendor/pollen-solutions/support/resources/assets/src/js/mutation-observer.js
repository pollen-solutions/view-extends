'use strict'

export default function (selector, callback) {
  const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
          if (mutation.type === 'childList') {
            if (mutation.addedNodes.length >= 1) {
              for (let i = 0; i < mutation.addedNodes.length; i++) {
                let $el = mutation.addedNodes[i]

                if ($el instanceof HTMLElement)
                  if ($el.matches(selector)) {
                    callback($el)
                  }
              }
            }
          }
        })
      }),
      observerConfig = {attributes: true, childList: true, characterData: true, subtree: true},
      targetNode = document.body

  return observer.observe(targetNode, observerConfig)
}