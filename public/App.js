'use strict';

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var _createClass = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);
    }
  }return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;
  };
}();

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

function _possibleConstructorReturn(self, call) {
  if (!self) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }return call && ((typeof call === "undefined" ? "undefined" : _typeof(call)) === "object" || typeof call === "function") ? call : self;
}

function _inherits(subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === "undefined" ? "undefined" : _typeof(superClass)));
  }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
}

var App = function (_Component) {
  _inherits(App, _Component);

  function App() {
    var _ref;

    var _temp, _this, _ret;

    _classCallCheck(this, App);

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    return _ret = (_temp = (_this = _possibleConstructorReturn(this, (_ref = App.__proto__ || Object.getPrototypeOf(App)).call.apply(_ref, [this].concat(args))), _this), _this.state = {
      company: [{ id: 1,
        field: "경영 기획 부문",
        teams: [{ id: 1,
          name: "IT 혁신팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 2,
          name: "OKR 추진팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 3,
          name: "재경팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 4,
          name: "회계팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }]
      }, { id: 2,
        field: "컴코 영업 부문",
        teams: [{ id: 1,
          name: "IT 혁신팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 2,
          name: "OKR 추진팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 3,
          name: "재경팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 4,
          name: "회계팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }]
      }, { id: 3,
        field: "유통 본부",
        teams: [{ id: 1,
          name: "IT 혁신팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 2,
          name: "OKR 추진팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 3,
          name: "재경팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 4,
          name: "회계팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }]
      }, { id: 4,
        field: "리테일 부문",
        teams: [{ id: 1,
          name: "IT 혁신팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 2,
          name: "OKR 추진팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 3,
          name: "재경팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }, { id: 4,
          name: "회계팀",
          minutes: [
            { num: 1,
              id: '1000000',
              date: "2021-09-10",
              update: "2021-10-15"
            },
            { num: 2,
              id: '1000001',
              date: "2021-10-01",
              update: "2021-10-01"
            },
            { num: 3,
              id: '1000009',
              date: "2021-10-08",
              update: "2021-10-13"
            }
          ]
        }]
      }]
    }, _temp), _possibleConstructorReturn(_this, _ret);
  }

  _createClass(App, [{
    key: 'render',
    value: function render() {
      return React.createElement(
        'div',
        { className: 'app' },
        React.createElement(MeetingsList, { company: this.state.company })
      );
    }
  }]);

  return App;
}(React.Component);

var MeetingsList = function (_Component) {
  _inherits(MeetingsList, _Component);

  function MeetingsList() {
      _classCallCheck(this, MeetingsList);

      return _possibleConstructorReturn(this, (MeetingsList.__proto__ || Object.getPrototypeOf(MeetingsList)).apply(this, arguments));
  }

  _createClass(MeetingsList, [{
      key: 'render',
      value: function render() {
          return React.createElement(
              ReactBootstrap.Accordion,
              { flush: "true" },
              this.props.company.map(function (item) {
                  return React.createElement(
                      ReactBootstrap.Accordion.Item,
                      { key: item.id, eventKey: item.id - 1 },
                      React.createElement(
                          ReactBootstrap.Accordion.Header,
                          null,
                          React.createElement(
                              'span',
                              { className: 'header-title' },
                              item.field
                          )
                      ),
                      React.createElement(
                          ReactBootstrap.Accordion.Body,
                          null,
                          React.createElement(Meeting, { teams: item.teams })
                      )
                  );
              })
          );
      }
  }]);

  return MeetingsList;
}(React.Component);

var Meeting = function (_Component) {
  _inherits(Meeting, _Component);

  function Meeting() {
      _classCallCheck(this, Meeting);

      return _possibleConstructorReturn(this, (Meeting.__proto__ || Object.getPrototypeOf(Meeting)).apply(this, arguments));
  }

  _createClass(Meeting, [{
      key: 'render',
      value: function render() {
          return React.createElement(
              React.Fragment,
              null,
              this.props.teams.map(function (team) {
                  return React.createElement(
                      ReactBootstrap.Accordion,
                      { className: 'meeting' },
                      React.createElement(
                          ReactBootstrap.Accordion.Item,
                          { key: team.id, eventKey: team.id - 1 },
                          React.createElement(
                              ReactBootstrap.Accordion.Header,
                              null,
                              React.createElement(
                                  'span',
                                  { className: 'header-title' },
                                  React.createElement('i', { className: 'fas fa-edit' }),
                                  team.name,
                                  ' 회의록'
                              ),
                              React.createElement(
                                'span',
                                { className: 'update-date' },
                                '최종 수정일'
                            )
                          ),
                          React.createElement(
                            ReactBootstrap.Accordion.Body,
                            null,
                            React.createElement(Minutes, { minutes: team.minutes }, null)
                          )
                      )
                  );
              })
          );
      }
  }]);

  return Meeting;
}(React.Component);

var Minutes = function (_Component) {
  _inherits(Minutes, _Component);

  function Minutes() {
      _classCallCheck(this, Minutes);

      return _possibleConstructorReturn(this, (Minutes.__proto__ || Object.getPrototypeOf(Minutes)).apply(this, arguments));
  }

  _createClass(Minutes, [{
      key: 'render',
      value: function render() {
          return React.createElement(
              React.Fragment,
              null,
              this.props.minutes.map(function (minute) {
                  return (
                    React.createElement(
                      'a',
                      { className: "minutes", href: "#" },
                      minute.date,
                      React.createElement(
                        'span',
                        { className: "update-date" },
                        minute.update
                      )
                    )
                  );
              })
          );
      }
  }]);

  return Minutes;
}(React.Component);

ReactDOM.render(React.createElement(App, null, null), document.getElementById('root'));