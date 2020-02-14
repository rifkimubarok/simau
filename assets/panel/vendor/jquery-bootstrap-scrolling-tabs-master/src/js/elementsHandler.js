/* ***********************************************************************************
 * ElementsHandler - Class that each instance of ScrollingTabsControl will instantiate
 * **********************************************************************************/
function ElementsHandler(scrollingTabsControl) {
  var ehd = this;

  ehd.stc = scrollingTabsControl;
}

// ElementsHandler prototype methods
(function (p) {
    p.initElements = function (options) {
      var ehd = this;

      ehd.setElementReferences();
      ehd.setEventListeners();
    };

    p.refreshAllElementSizes = function () {
      var ehd = this,
          stc = ehd.stc,
          smv = stc.scrollMovement,
          scrollArrowsWereVisible = stc.scrollArrowsVisible,
          actionsTaken = {
            didScrollToActiveTab: false
          },
          isPerformingSlideAnim = false,
          minPos;

      ehd.setElementWidths();
      ehd.setScrollArrowVisibility();

      // this could have been a window resize or the removal of a
      // dynamic tab, so make sure the movable container is positioned
      // correctly because, if it is far to the left and we increased the
      // window width, it's possible that the tabs will be too far left,
      // beyond the min pos.
      if (stc.scrollArrowsVisible) {
        // make sure container not too far left
        minPos = smv.getMinPos();

        isPerformingSlideAnim = smv.scrollToActiveTab({
          isOnWindowResize: true
        });

        if (!isPerformingSlideAnim) {
          smv.refreshScrollArrowsDisabledState();

          if (stc.movableContainerLeftPos < minPos) {
            smv.incrementMovableContainerRight(minPos);
          }
        }

        actionsTaken.didScrollToActiveTab = true;

      } else if (scrollArrowsWereVisible) {
        // scroll arrows went away after resize, so position movable container at 0
        stc.movableContainerLeftPos = 0;
        smv.slideMovableContainerToLeftPos();
      }

      return actionsTaken;
    };

    p.setElementReferences = function () {
      var ehd = this,
          stc = ehd.stc,
          $tabsContainer = stc.$tabsContainer,
          $leftArrow = $tabsContainer.find('.scrtabs-tab-scroll-arrow-left'),
          $rightArrow = $tabsContainer.find('.scrtabs-tab-scroll-arrow-right');

      stc.isNavPills = false;

      stc.$fixedContainer = $tabsContainer.find('.scrtabs-tabs-fixed-container');
      stc.$movableContainer = $tabsContainer.find('.scrtabs-tabs-movable-container');
      stc.$tabsUl = $tabsContainer.find('.nav-tabs');

      // check for pills
      if (!stc.$tabsUl.length) {
        stc.$tabsUl = $tabsContainer.find('.nav-pills');

        if (stc.$tabsUl.length) {
          stc.isNavPills = true;
        }
      }

      stc.$tabsLiCollection = stc.$tabsUl.find('> li');

      stc.$slideLeftArrow = stc.reverseScroll ? $leftArrow : $rightArrow;
      stc.$slideRightArrow = stc.reverseScroll ? $rightArrow : $leftArrow;
      stc.$scrollArrows = stc.$slideLeftArrow.add(stc.$slideRightArrow);

      stc.$win = $(window);
    };

    p.setElementWidths = function () {
      var ehd = this,
          stc = ehd.stc;

      stc.winWidth = stc.$win.width();
      stc.scrollArrowsCombinedWidth = stc.$slideLeftArrow.outerWidth() + stc.$slideRightArrow.outerWidth();

      ehd.setFixedContainerWidth();
      ehd.setMovableContainerWidth();
    };

    p.setEventListeners = function () {
      var ehd = this,
          stc = ehd.stc,
          evh = stc.eventHandlers,
          ev = CONSTANTS.EVENTS;

      stc.$slideLeftArrow
        .off('.scrtabs')
        .on(ev.MOUSEDOWN, function (e) { evh.handleMousedownOnSlideMovContainerLeftArrow.call(evh, e); })
        .on(ev.MOUSEUP, function (e) { evh.handleMouseupOnSlideMovContainerLeftArrow.call(evh, e); })
        .on(ev.CLICK, function (e) { evh.handleClickOnSlideMovContainerLeftArrow.call(evh, e); });

      stc.$slideRightArrow
        .off('.scrtabs')
        .on(ev.MOUSEDOWN, function (e) { evh.handleMousedownOnSlideMovContainerRightArrow.call(evh, e); })
        .on(ev.MOUSEUP, function (e) { evh.handleMouseupOnSlideMovContainerRightArrow.call(evh, e); })
        .on(ev.CLICK, function (e) { evh.handleClickOnSlideMovContainerRightArrow.call(evh, e); });

      if (stc.tabClickHandler) {
        stc.$tabsLiCollection
          .find('a[data-toggle="tab"]')
          .off(ev.CLICK)
          .on(ev.CLICK, stc.tabClickHandler);
      }

      stc.$win.off('.scrtabs').smartresize(function (e) { evh.handleWindowResize.call(evh, e); });

      $('body').on(CONSTANTS.EVENTS.FORCE_REFRESH, stc.elementsHandler.refreshAllElementSizes.bind(stc.elementsHandler));
    };

    p.setFixedContainerWidth = function () {
      var ehd = this,
          stc = ehd.stc,
          tabsContainerRect = stc.$tabsContainer.get(0).getBoundingClientRect();
      /**
       * @author poletaew
       * It solves problem with rounding by jQuery.outerWidth
       * If we have real width 100.5 px, jQuery.outerWidth returns us 101 px and we get layout's fail
       */
      stc.fixedContainerWidth = tabsContainerRect.width || (tabsContainerRect.right - tabsContainerRect.left);
      stc.fixedContainerWidth = stc.fixedContainerWidth * stc.widthMultiplier;

      stc.$fixedContainer.width(stc.fixedContainerWidth);
    };

    p.setFixedContainerWidthForHiddenScrollArrows = function () {
      var ehd = this,
          stc = ehd.stc;

      stc.$fixedContainer.width(stc.fixedContainerWidth);
    };

    p.setFixedContainerWidthForVisibleScrollArrows = function () {
      var ehd = this,
          stc = ehd.stc;

      stc.$fixedContainer.width(stc.fixedContainerWidth - stc.scrollArrowsCombinedWidth);
    };

    p.setMovableContainerWidth = function () {
      var ehd = this,
          stc = ehd.stc,
          $tabLi = stc.$tabsUl.find('> li');

      stc.movableContainerWidth = 0;

      if ($tabLi.length) {

        $tabLi.each(function () {
          var $li = $(this),
              totalMargin = 0;

          if (stc.isNavPills) { // pills have a margin-left, tabs have no margin
            totalMargin = parseInt($li.css('margin-left'), 10) + parseInt($li.css('margin-right'), 10);
          }

          stc.movableContainerWidth += ($li.outerWidth() + totalMargin);
        });

        stc.movableContainerWidth += 1;

        // if the tabs don't span the width of the page, force the
        // movable container width to full page width so the bottom
        // border spans the page width instead of just spanning the
        // width of the tabs
        if (stc.movableContainerWidth < stc.fixedContainerWidth) {
          stc.movableContainerWidth = stc.fixedContainerWidth;
        }
      }

      stc.$movableContainer.width(stc.movableContainerWidth);
    };

    p.setScrollArrowVisibility = function () {
      var ehd = this,
          stc = ehd.stc,
          shouldBeVisible = stc.movableContainerWidth > stc.fixedContainerWidth;

      if (shouldBeVisible && !stc.scrollArrowsVisible) {
        stc.$scrollArrows.show();
        stc.scrollArrowsVisible = true;
      } else if (!shouldBeVisible && stc.scrollArrowsVisible) {
        stc.$scrollArrows.hide();
        stc.scrollArrowsVisible = false;
      }

      if (stc.scrollArrowsVisible) {
        ehd.setFixedContainerWidthForVisibleScrollArrows();
      } else {
        ehd.setFixedContainerWidthForHiddenScrollArrows();
      }
    };

}(ElementsHandler.prototype));
