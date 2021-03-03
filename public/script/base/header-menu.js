const womanTitle = document.getElementById("woman-title")
const womanWindow = document.getElementById("woman-window")
const womanDiv = document.getElementById("woman-div")

const manTitle = document.getElementById("man-title")
const manWindow = document.getElementById("man-window")
const manDiv = document.getElementById("woman-div")

const childrenTitle = document.getElementById("children-title")
const childrenWindow = document.getElementById("children-window")

const mousleave1 = $('.sub_header')
const mousleave2 = $('.right_sub_header')


for (var i = 0; i < mousleave1.length; i++){
  mousleave1.mouseleave(function(){
    womanWindow.style.display = 'none'
    manWindow.style.display = 'none'
    childrenWindow.style.display = 'none'
  })
  mousleave2.mouseover(function(){
    womanWindow.style.display = 'none'
    manWindow.style.display = 'none'
    childrenWindow.style.display = 'none'
  })
}


womanWindow.style.display = 'none'
manWindow.style.display = 'none'
childrenWindow.style.display = 'none'

document.addEventListener('click', () => {
  womanWindow.style.display = 'none'
  manWindow.style.display = 'none'
  childrenWindow.style.display = 'none'
})

womanTitle.addEventListener('mouseover', () => {
  womanWindow.style.display = ''
  manWindow.style.display = 'none'
  childrenWindow.style.display = 'none'
})

womanTitle.addEventListener('touchstart', (e) => {
  womanWindow.style.display = ''
  manWindow.style.display = 'none'
  childrenWindow.style.display = 'none'
  e.preventDefault()
})

manTitle.addEventListener('mouseover', () => {
  womanWindow.style.display = 'none'
  manWindow.style.display = ''
  childrenWindow.style.display = 'none'
})

manTitle.addEventListener('touchstart', (e) => {
  womanWindow.style.display = 'none'
  manWindow.style.display = ''
  childrenWindow.style.display = 'none'
  e.preventDefault()
})

childrenTitle.addEventListener('mouseover', () => {
  womanWindow.style.display = 'none'
  manWindow.style.display = 'none'
  childrenWindow.style.display = ''
})

childrenTitle.addEventListener('touchstart', (e) => {
  womanWindow.style.display = 'none'
  manWindow.style.display = 'none'
  childrenWindow.style.display = ''
  e.preventDefault()
})