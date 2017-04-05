// Filename: router.js
define([
    'jquery',
    'underscore',
    'backbone', ], function($, _, Backbone) {
        var AppRouter = Backbone.Router.extend({
            routes: {
                'category': 'category',
                'category/*path': 'category',
                'users': 'users',
                'users/*path': 'users',
                'resource': 'resource',
                'resource/*path': 'resource',
                'article': 'article',
                'article/*path': 'article',
                'menu': 'menu',
                'menu/*path': 'menu',
                'page': 'page',
                'page/*path': 'page',
                'language': 'language',
                'language/*path': 'language',
                'media': 'media',
                'media/*path': 'media',
                'help': 'help',
                'help/*path': 'help',
                'sysformat': 'sysformat',
                'sysformat/*path': 'sysformat',
                'home': 'home',
                'home/*path': 'home',
                'import': 'importIndexes',
                'import/all': 'importIndexes',
                'import/': 'importIndexes',
                'caculation': 'caculation',
                'caculation/all': 'caculation',
                'backhistory_calculation': 'backhistory_calculation',
                'backhistory_calculation/all': 'backhistory_calculation',
                'action': 'action',
                'action/*path': 'action',
                'action_history': 'actionHistory',
                'action_history/*path': 'actionHistory',
                'calendar_page': 'calendarPage',
                'calendar_page/*path': 'calendarPage',
                'idx_page': 'idxPage',
                'idx_page/*path': 'idxPage',
                'profile': 'profile',
                'profile/*path': 'profile',
                'hnx': 'hnx',
                'hnx/*path': 'hnx',
                'upcom': 'upcom',
                'upcom/*path': 'upcom',
                'hsx': 'hsx',
                'hsx/*path': 'hsx',
                'download': 'download',
                'download/*path': 'download',
                'download_temp': 'download_temp',
                'download_temp/*path': 'download_temp',
                'steps': 'steps',
                'steps/*path': 'steps',
                'document': 'document',
                'document/*path': 'document',
                'file_daily': 'file_daily',
                'file_daily/*path': 'file_daily',
                'report': 'report',
                'report/*path': 'report',
                'reference': 'reference',
                'reference/*path': 'reference',
                'prices': 'prices',
                'prices/*path': 'prices',
                'daily': 'daily',
                'daily/*path': 'daily',
                'vndb_report': 'vndbReport',
                'vndb_report/*path': 'vndbReport',
                'vndb_report_history': 'vndbReportHistory',
                'vndb_report_history/*path': 'vndbReportHistory',
                'anomalies': 'anomalies',
                'anomaliesView/*path': 'anomaliesView',
                'update_shares': 'update_shares',
                'update_shares/*path': 'update_shares',
                'vndb_prices_history': 'vndb_prices_history',
                'vndb_prices_history/*path': 'vndb_prices_history',
                'statics': 'statics',
                'statics/*path': 'statics',
                'dividend_report': 'dividendReport',
                'dividend_report/*path': 'dividendReport',
                'dividends': 'dividends',
                'dividends/*path': 'dividends',
                'cpaction': 'cpaction',
                'cpaction/*path': 'cpaction',
                'indexes': 'indexes',
                'indexes/*path': 'indexes',
                'currency': 'currency',
                'currency/*path': 'currency',
                'vndb_page': 'VNDBPage',
                'vndb_page/*path': 'VNDBPage',
                'synchronization': 'synchronization',
                'synchronization/*path': 'synchronization',
                'service': 'service',
                'service/*path': 'service',
                'services': 'services',
                'services/*path': 'services',
                'fundamental': 'fundamental',
                'fundamental/*path': 'fundamental',
                'statistics': 'statistics',
                'statistics/*path': 'statistics',
                'events': 'events',
                'events/*path': 'events',
                'economic': 'economic',
                'economic/*path': 'economic',
                'news': 'news',
                'news/*path': 'news',
                '*actions': 'defaultAction'

            },
            news: function(){
                require(['views/news'], function(newsView){
                    newsView.render();
                });
            },
            economic: function(){
                require(['views/economic'], function(ecomView){
                    ecomView.render();
                });
            },
            events: function(){
                require(['views/events'], function(eventsView){
                    eventsView.render();
                });
            },
            VNDBPage: function() {
                require(['views/vndb_page/list'], function(VNDBPageView) {
                    VNDBPageView.render();
                });
            },
            dividends: function() {
                require(['views/dividends'], function(dividendView) {
                    dividendView.render();
                });
            },
            cpaction: function() {
                require(['views/cpaction'], function(cpactionView) {
                    cpactionView.render();
                });
            },
            indexes: function() {
                require(['views/indexes'], function(indexesView) {
                    indexesView.render();
                });
            },
            currency: function() {
                require(['views/currency'], function(currencyView) {
                    currencyView.render();
                });
            },
            fundamental: function() {
                require(['views/fundamental'], function(fundamentalView) {
                    fundamentalView.render();
                });
            },
            statistics: function() {
                require(['views/statistics'], function(statisticsView) {
                    statisticsView.render();
                });
            },
            dividendReport: function() {
                require(['views/dividend_report'], function(reportView) {
                    reportView.render();
                });
            },
            vndbReportHistory: function() {
                require(['views/vndb_report_history'], function(reportView) {
                    reportView.render();
                });
            },
            vndbReport: function() {
                require(['views/vndb_report'], function(reportView) {
                    reportView.render();
                });
            },
            file_daily: function() {
                require(['views/file_daily'], function(fileView) {
                    fileView.render();
                });
            },
            report: function() {
                require(['views/report'], function(fileView) {
                    fileView.render();
                });
            },
            daily: function() {
                require(['views/daily'], function(fileView) {
                    fileView.render();
                });
            },
            reference: function() {
                require(['views/reference'], function(fileView) {
                    fileView.render();
                });
            },
            prices: function() {
                require(['views/prices'], function(fileView) {
                    fileView.render();
                });
            },
            steps: function() {
                require(['views/steps'], function(stepsView) {
                    stepsView.render();
                });
            },
            download: function() {
                require(['views/download'], function(downloadView) {
                    downloadView.render();
                });
            },
            download_temp: function() {
                require(['views/download_temp'], function(downloadTempView) {
                    downloadTempView.render();
                });
            },
            hsx: function() {
                require(['views/hsx/list'], function(hsxView) {
                    hsxView.render();
                });
            },
            hnx: function() {
                require(['views/hnx/list'], function(hnxView) {
                    hnxView.render();
                });
            },
            upcom: function() {
                require(['views/upcom/list'], function(upcomView) {
                    upcomView.render();
                });
            },
            idxPage: function() {
                require(['views/idx_page/list'], function(idxPageView) {
                    idxPageView.render();
                });
            },
            calendarPage: function() {
                require(['views/calendar_page/list'], function(calendarPageView) {
                    calendarPageView.render();
                });
            },
            home: function() {
                require(['views/home/list'], function(homeView) {
                    homeView.render();
                });
            },
            sysformat: function() {
                require(['views/sysformat/list'], function(sysformatView) {
                    sysformatView.render();
                });
            },
            category: function() {
                require(['views/category/list'], function(categoryView) {
                    categoryView.render();
                });
            },
            users: function() {
                require(['views/users'], function(userView) {
                    userView.render();
                });
            },
            resource: function() {
                require(['views/resource'], function(resourceView) {
                    resourceView.render();
                });
            },
            service: function() {
                require(['views/service'], function(serviceView) {
                    serviceView.render();
                });
            },
            services: function() {
                require(['views/services/list'], function(servicesView) {
                    servicesView.render();
                });
            },
            article: function() {
                require(['views/article'], function(articleView) {
                    articleView.render();
                });
            },
            menu: function() {
                require(['views/menu'], function(menuView) {
                    menuView.render();
                });
            },
            page: function() {
                require(['views/page'], function(pageView) {
                    pageView.render();
                });
            },
            language: function() {
                require(['views/language'], function(languageView) {
                    languageView.render();
                });
            },
            media: function() {
                require(['views/media'], function(mediaView) {
                    mediaView.render();
                });
            },
            help: function() {
                require(['views/help'], function(helpDetailView) {
                    helpDetailView.render();
                });
            },
            importIndexes: function() {
                require(['views/import-indexes'], function(importIndexesView) {
                    importIndexesView.render();
                });
            },
            document: function() {
                require(['views/document'], function(documentView) {
                    documentView.render();
                });
            },
            caculation: function() {
                require(['views/caculation'], function(caculationView) {
                    caculationView.render();
                });
            },
            action: function($a) {
                require(['views/action-list'], function(actionListView) {
                    actionListView.render();
                });
            },
            actionHistory: function($a) {
                require(['views/action_history'], function(actionHistoryView) {
                    actionHistoryView.render();
                });
            },
            calculationHistory: function($a) {
                require(['views/backhistory_calculation'], function(calculationHistoryView) {
                    calculationHistoryView.render();
                });
            },
            update_shares: function() {
                require(['views/update_shares'], function(update_sharesView) {
                    update_sharesView.render();
                });
            },
            vndb_prices_history: function() {
                require(['views/vndb_prices_history'], function(vndb_prices_historyView) {
                    vndb_prices_historyView.render();
                });
            },
            synchronization: function() {
                require(['views/synchronization'], function(synchronizationView) {
                    synchronizationView.render();
                });
            },

            defaultAction: function(actions) {
            // We have no matching route, lets display the home page
            }
        });
        var initialize = function() {
            var app_router = new AppRouter;
            Backbone.history.start({
                pushState: true,
                root: "/vnfdb/backend/"
            });
            $('.download-ownership').click(function() {
                require(['views/download'], function(downloadView) {
                    downloadView.ownership();
                })
            });
            $('.download-dividend').click(function() {
                require(['views/download'], function(downloadView) {
                    downloadView.dividend();
                })
            });
            $('.import-equity').click(function() {
                require(['views/download'], function(downloadView) {
                    downloadView.import_equity();
                })
            });
            $('.action-update-return').click(function() {
                require(['views/update_return'], function(updateReturnView) {
                    updateReturnView.index();
                });
            });
            $('.action-update-shares').click(function() {
                require(['views/update_shares'], function(update_sharesView) {
                    update_sharesView.doUpdateShares();
                });
            });
            $('.action-vndb-prices-history').click(function() {
                require(['views/vndb_prices_history'], function(vndb_prices_historyView) {
                    vndb_prices_historyView.doPricesHistory();
                });
            });
            $('.action-qidx-mdata').click(function() {
                require(['views/vndb_prices_history'], function(vndb_prices_historyView) {
                    vndb_prices_historyView.doQidxmdata();
                });
            });
            $('.action-export-qidx-mdata').click(function() {
                require(['views/vndb_prices_history'], function(vndb_prices_historyView) {
                    vndb_prices_historyView.doExportQidxmdata();
                });
            });
            $('.action-insert-meta-prices').click(function() {
                require(['views/vndb_prices_history'], function(vndb_prices_historyView) {
                    vndb_prices_historyView.doInsertMetaPrices();
                });
            });
            $('.action-update-references').click(function() {
                require(['views/vndb_prices_history'], function(vndb_prices_historyView) {
                    vndb_prices_historyView.doUpdateReferences();
                });
            });
            $('.action-insert-data-update-return').click(function() {
                require(['views/update_return'], function(updateReturnView) {
                    updateReturnView.insert_data();
                });
            });
            $('.action-clear-data-update-return').click(function() {
                require(['views/update_return'], function(updateReturnView) {
                    updateReturnView.clear_data();
                });
            });
            $('.action-calculate-return-update-return').click(function() {
                require(['views/update_return'], function(updateReturnView) {
                    updateReturnView.calculate_return();
                });
            });
            $('.action-adjusted-price-update-return').click(function() {
                require(['views/update_return'], function(updateReturnView) {
                    updateReturnView.adjusted_price();
                });
            });

            $('#reference-anomalies').click(function() {
                require(['views/reference_anomalies'], function(reference_anomaliesView) {
                    reference_anomaliesView.check();
                });
            });
            $('.action-import-economic').click(function() {
                require(['views/economic'], function(ecomView){
                    ecomView.doImportEconomic();
                });
            });
        };
        return {
            initialize: initialize
        };
    });