'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

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
        teams: [{ name: "IT 혁신팀",
          update: "2021-09-10"
        }, { name: "OKR 추진팀",
          update: "2021-09-10"
        }, { name: "재경팀",
          update: "2021-09-10"
        }, { name: "회계팀",
          update: "2021-09-10"
        }]
      }, { id: 2,
        field: "컴코 영업 부문",
        teams: [{ name: "IT 혁신팀",
          update: "2021-09-10"
        }, { name: "OKR 추진팀",
          update: "2021-09-10"
        }, { name: "재경팀",
          update: "2021-09-10"
        }, { name: "회계팀",
          update: "2021-09-10"
        }]
      }, { id: 3,
        field: "유통 본부",
        teams: [{ name: "IT 혁신팀",
          update: "2021-09-10"
        }, { name: "OKR 추진팀",
          update: "2021-09-10"
        }, { name: "재경팀",
          update: "2021-09-10"
        }, { name: "회계팀",
          update: "2021-09-10"
        }]
      }, { id: 4,
        field: "리테일 부문",
        teams: [{ name: "IT 혁신팀",
          update: "2021-09-10"
        }, { name: "OKR 추진팀",
          update: "2021-09-10"
        }, { name: "재경팀",
          update: "2021-09-10"
        }, { name: "회계팀",
          update: "2021-09-10"
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
              null,
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
                          ),
                          React.createElement(
                              'span',
                              { className: 'update-date' },
                              '\uCD5C\uC885 \uC218\uC815\uC77C'
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
                      'a',
                      { className: 'meeting', href: '/home/sprint' },
                      React.createElement('i', { className: 'fas fa-edit' }),
                      React.createElement(
                          'span',
                          null,
                          team.name,
                          ' \uD68C\uC758\uB85D'
                      ),
                      React.createElement(
                          'span',
                          { className: 'update-date' },
                          team.update
                      )
                  );
              })
          );
      }
  }]);

  return Meeting;
}(React.Component);

ReactDOM.render(React.createElement(App, null, null), document.getElementById('root'));