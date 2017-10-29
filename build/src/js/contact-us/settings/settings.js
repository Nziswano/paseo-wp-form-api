import {setting} from './model'
import {SettingView} from './view'

console.log('settings')
// console.log(setting)
export function settings () {
  let view = new SettingView({
    model: setting,
    el: '#app'
  })
  return view
}
