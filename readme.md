# Valet *WSL*
[![Build Status](https://travis-ci.com/valeryan/valet-wsl.svg?branch=master)](https://travis-ci.com/valeryan/valet-wsl) 
![GitHub release](https://img.shields.io/github/release/valeryan/valet-wsl.svg)
![GitHub Release Date](https://img.shields.io/github/release-date/valeryan/valet-wsl.svg)
![GitHub](https://img.shields.io/github/license/valeryan/valet-wsl.svg)

## Maintenance Status
A while ago I moved on from php and now work in dotnet. I do currently have the bandwidth to work on this project. If you want to take over this project or just be an additionly maintainer and help solve any of the issues that are present, please contact me.

## Introduction

Valet for WSL provides a way to quickly setup a development environment for Laravel using Valet in Windows Subsystem for Linux.

## Known Limitations and Issues

Currently I have not been able to get Windows to talk to dnsmasq so another solution has to be found. Also, `valet secure` will not be seamless and will require a windows script be run after a site is secured to install the certs in Windows. 

## Current Goals

My current goal is to come as close to creating the valet experience as possible on windows. I will accomplish this by modifying the valet script to be able to handle WSL problems. I am pretty sure I will not be able to remove the need to install the ssl certificate authroity in windows and unless I get dnsmasq to work one day a windows dns proxy will have to be installed and configured. 

## Official Documentation

Documentation for Valet can be found on the [Valet Linux website](https://cpriego.github.io/valet-linux/).

## Setup Procedures

Documentation for how I setup and use this version of valet on my own system: [Valet WSL Wiki](https://github.com/valeryan/valet-wsl/wiki/Installation-Guide).

## License

Laravel Valet is an open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
