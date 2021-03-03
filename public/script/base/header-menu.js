const womanTitle = document.getElementById("woman-title")
const womanWindow = document.getElementById("woman-window")

const manTitle = document.getElementById("man-title")
const manWindow = document.getElementById("man-window")

const childrenTitle = document.getElementById("children-title")
const childrenWindow = document.getElementById("children-window")

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