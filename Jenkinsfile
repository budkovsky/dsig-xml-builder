/*
Jenkins version: 2.204.2
Docker Version: 19.03.5
Docker custom build: jenkins/jenkins:lts(jenkins/jenkins:2.204.2) + Dockerfile
Docker base image identity(used in "FROM" command in Dockerfile):
 - Image ID: d9abe6b78d13(sha256:d9abe6b78d139ce22debcfe6fdc05f6edc614735479134b60d0b162d78dbba0a)
 - RepoTags: jenknis/jenkins:lts
 - RepoDigests: jenkins/jenkins@sha256:54486ebab0d42582a84fc35b184c4f5cf9998d139bbec552bc6ec8c617c4a055 
Plugins:
 - Credentials Bindings
 - GitHHub Branch Source
 - Pipeline
 - Clover
 - Warnings Next Generation
 - HTML Publisher
*/
pipeline {
    agent { dockerfile true }
    stages {
        stage('build') {
    	    steps {
    	        sh 'composer install'
    	    }
        }
        stage('test') {
            steps {
         		sh 'vendor/bin/phpunit --bootstrap vendor/autoload.php --log-junit reports/phpunit.xml --coverage-clover reports/clover.xml --coverage-xml reports --coverage-html reports --coverage-crap4j reports/crap4j.xml --whitelist src/ tests'       
            }
        }
        stage('analyze') {
        	steps {
	            sh 'vendor/bin/phpcs -p --report=checkstyle --report-file=`pwd`/reports/checkstyle-result.xml --standard=PSR2 src/ || exit 0'
	            sh 'vendor/bin/phpcpd --progress --log-pmd=reports/cpd.xml src/ || exit 0'
	            sh 'vendor/bin/pdepend --summary-xml=reports/pdepend.xml --jdepend-chart=reports/jdepend-chart.svg --overview-pyramid=reports/jdepend-overview-pyramid.svg src/'
	            sh 'vendor/bin/phpmd src/ xml ruleset.xml --ignore-violations-on-exit --reportfile reports/pmd.xml'
	            sh 'vendor/bin/phploc --log-xml=reports/phploc.xml --log-csv=reports/phploc.csv src/'
        	}
        }
        stage('report') {
            steps {
	            junit 'reports/*.xml'        	    
	        	step([
		            $class              : "CloverPublisher",
		            cloverReportDir     : "reports",
		            cloverReportFileName: "clover.xml",
		            healthyTarget: [methodCoverage: 10, conditionalCoverage: 10, statementCoverage: 10],
		            unhealthyTarget: [methodCoverage: 5, conditionalCoverage: 5, statementCoverage: 5],
		            failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0],
	            ])
	            recordIssues enabledForFailure: true, tool: checkStyle(), qualityGates: [[threshold: 10, type: 'TOTAL', unstable: true]], healthy: 10, unhealthy: 100, minimumSeverity: 'HIGH'
	            recordIssues enabledForFailure: true, tool: cpd(), qualityGates: [[threshold: 10, type: 'TOTAL', unstable: true]], healthy: 10, unhealthy: 100, minimumSeverity: 'HIGH'
	            recordIssues enabledForFailure: true, tool: pmdParser(), qualityGates: [[threshold: 10, type: 'TOTAL', unstable: true]], healthy: 10, unhealthy: 100, minimumSeverity: 'HIGH' 
            }
        }
        stage('documentation') {
            steps {
	            sh 'vendor/bin/phpdox -f phpdox.xml'
	            publishHTML (target: [
	                allowMissing: false,
	                alwaysLinkToLastBuild: false,
	                keepAll: true,
	                reportDir: 'reports/phpdox/html',
	                reportFiles: 'index.xhtml',
	                reportName: "PHPDox Documentation"
		        ])  
            }       
        }
    }
}