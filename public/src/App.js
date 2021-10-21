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

class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      fields: {
        contents: [],
        isLoading: false
      }
    };
  }

  componentDidMount() {
    var newList = Object.assign({}, this.state.fields, {isLoading: true});
    this.setState({fields: newList});
    
    var field_count = 1;
    var field = '';
    var team_count = 1;
    var team = '';
    var meeting_count = 0;
    var fields = new Array();
    var teams = new Array();
    var meetings = new Array();

    this.props.fields.forEach(data => {
      meetings.push({id: data.ID, date: data.MEET_DT, update: data.UPDATE_DT});
      meeting_count++;
      if (team != data.DEPT_NM && team != '') {
        teams.push({num: team_count, name: team, meetings: meetings});
        meetings.splice(0, meeting_count-1);
        meeting_count = 0;
        team_count++;
      } 
      if (field != data.DEPT_UP_NM && field != '') {
        fields.push({num: field_count, name: field, teams: teams});
        teams.splice(0, team_count-1);
        team_count = 1;
        field_count++;
      }
      field = data.DEPT_UP_NM;
      team = data.DEPT_NM;
      if (meeting_count == this.props.fields.length) {
        teams.push({num: team_count, name: team, meetings: meetings});
        fields.push({num: field_count, name: field, teams: teams});
      }
    });

    this.setState({
      fields: {
        contents: fields,
        isLoading: false
      }
    });
  }

  render() {
    return (
      <div className="app">
        <MeetingsList fields={this.state.fields} />
      </div>
    );
  }

}

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
              this.props.fields.contents && this.props.fields.contents.map(function (item) {
                  return React.createElement(
                      ReactBootstrap.Accordion.Item,
                      { key: item.num, eventKey: item.num - 1 },
                      React.createElement(
                          ReactBootstrap.Accordion.Header,
                          null,
                          React.createElement(
                              'span',
                              { className: 'header-title' },
                              item.name
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
                          { key: team.num, eventKey: team.num - 1 },
                          React.createElement(
                              ReactBootstrap.Accordion.Header,
                              null,
                              React.createElement(
                                  'span',
                                  { className: 'header-title' },
                                  React.createElement('i', { className: "fa fa-edit" }),
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
                            React.createElement(Minutes, { meetings: team.meetings }, null)
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
              this.props.meetings.map(function (meeting) {
                  return (
                    React.createElement(
                      'a',
                      { className: "minutes", href: `/Sprint_Meet_Controller/spr_main_id/${meeting.id}` },
                      React.createElement('i', { className: "far fa-sticky-note" }, null),
                      React.createElement('span', { className: "meeting-date" }, meeting.date),
                      React.createElement('span', { className: "update-date" }, meeting.update === '' ? '-' : meeting.update)
                    )
                  );
              })
          );
      }
  }]);

  return Minutes;
}(React.Component);

