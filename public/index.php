<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

#Zipkin
use Zipkin\Annotation;
use Zipkin\Endpoint;
use Zipkin\Samplers\BinarySampler;
use Zipkin\TracingBuilder;
use Zipkin\Reporters\Http;

#Open Telemetry
// use OpenTelemetry\Contrib\Jaeger\Exporter as JaegerExporter;
// use OpenTelemetry\Contrib\Zipkin\Exporter as ZipkinExporter;
// use OpenTelemetry\SDK\AbstractClock;
// use OpenTelemetry\Context\Context;
// use OpenTelemetry\SDK\Trace\Sampler\AlwaysOnSampler;
// use OpenTelemetry\SDK\Trace\SamplingResult;
// use OpenTelemetry\SDK\Trace\SpanProcessor\BatchSpanProcessor;
// use OpenTelemetry\SDK\Trace\TracerProvider;
// use OpenTelemetry\API\Trace as API;
// use GuzzleHttp\Client;
// use GuzzleHttp\Psr7\HttpFactory;

#Jaeger
// use Jaeger\Config;
// use OpenTracing\GlobalTracer;


define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

#Zipkin Client Library(openzipkin/zipkin) to test tracing

// First we create the endpoint that describes our service
//$endpoint = Endpoint::create('my_service');

//$reporter = new Http(['endpoint_url' => 'http://myzipkin:9411/api/v2/spans']);
//$sampler = BinarySampler::createAsAlwaysSample();
//$tracing = TracingBuilder::create()
//    ->havingLocalEndpoint($endpoint)
//    ->havingSampler($sampler)
//    ->havingReporter($reporter)
//    ->build();
//
//$tracer = $tracing->getTracer();
//
//$tracer->flush();


// before you send a request, add metadata that describes the operation
//$span = $tracer->newTrace();
//$span->setName('get');
//$span->setKind(Kind\CLIENT);
//$span->tag('http.status_code', '200');
//$span->tag(Tags\HTTP_PATH, '/api');
//$span->setRemoteEndpoint(Endpoint::create('backend', 127 << 24 | 1, null, 8080));

// when the request is scheduled, start the span
//$span->start();

// if you have callbacks for when data is on the wire, note those events
//$span->annotate(Annotation\WIRE_SEND);
//$span->annotate(Annotation\WIRE_RECV);

// when the response is complete, finish the span
//$span->finish();



#Jaeger jaeger-client-php library

// $config = new Config(
//     [
//         'sampler' => [
//             'type' => Jaeger\SAMPLER_TYPE_CONST,
//             'param' => true,
//         ],
//         'logging' => true,
//     ],
//     'grafana-tracing'
// );
// $config->initializeTracer();

// $tracer = GlobalTracer::get();

// $scope = $tracer->startActiveSpan('TestSpan', []);
// $scope->close();

// $tracer->flush();






#OpenTelemetry API
// $sampler = new AlwaysOnSampler();
// $samplingResult = $sampler->shouldSample(
//     new Context(),
//     md5((string) microtime(true)),
//     'io.opentelemetry.example',
//     API\SpanKind::KIND_INTERNAL
// );


// $jaegerExporter = new JaegerExporter(
//     'Hello World Web Server Jaeger',
//     'http://localhost:9412/api/v2/spans',
//     new Client(),
//     new HttpFactory(),
//     new HttpFactory()
// );

// $zipkinExporter = new ZipkinExporter(
//     'Hello World Web Server Zipkin',
//     'http://localhost:9411/api/v2/spans',
//     new Client(),
//     new HttpFactory(),
//     new HttpFactory()
// );

// if (SamplingResult::RECORD_AND_SAMPLE === $samplingResult->getDecision()) {

//     $jaegerTracer = (new TracerProvider(null, $sampler))
//         ->addSpanProcessors(new BatchSpanProcessor($jaegerExporter, Clock::get()))
//         ->getTracer('io.opentelemetry.contrib.php');

//     // $zipkinTracer = (new TracerProvider(null, $sampler))
//     // ->addSpanProcessor(new BatchSpanProcessor($zipkinExporter, Clock::get()))
//     // ->getTracer('io.opentelemetry.contrib.php');

//     // $request = Request::createFromGlobals();
//     // $jaegerSpan = $jaegerTracer->startAndActivateSpan($request->getUri());
//     // $zipkinSpan = $zipkinTracer->startAndActivateSpan($request->getUri());

// }

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);



// if (SamplingResult::RECORD_AND_SAMPLE === $samplingResult->getDecision()) {
//     $zipkinSpan->end();
//     $jaegerSpan->end();
// }
